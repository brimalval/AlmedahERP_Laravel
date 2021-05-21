<?php

namespace App\Http\Controllers;

use App\Models\MaterialPurchased;
use App\Models\PaymentInvoiceLog;
use App\Models\PurchaseInvoice;
use App\Models\PurchaseReceipt;
use App\Models\SuppliersQuotation;
use Illuminate\Http\Request;
use DB;
use Exception;

class PurchaseInvoiceController extends Controller
{
    //
    public function index()
    {
        $purchase_invoice = PurchaseInvoice::all();
        return view('modules.buying.purchaseinvoice', ['invoices' => $purchase_invoice]);
    }

    public function openInvoiceForm()
    {
        $receipts = PurchaseReceipt::where('pr_status', 'NOT LIKE', 'Draft')->get();
        return view('modules.buying.newPurchaseInvoice', ['receipts' => $receipts]);
    }

    public function viewInvoice($id)
    {
        $invoice = PurchaseInvoice::find($id);
        $received_items = $invoice->receipt->order->itemsPurchased();
        $supplier = $invoice->receipt->order->supplier_quotation->supplier;
        $logs = $invoice->invoice_logs;
        return view('modules.buying.purchaseInvoiceInfo', ['invoice' => $invoice, 'received_items' => $received_items, 'supplier' => $supplier, 'logs' => $logs]);
    }

    public function updateInvoiceStatus($id)
    {
        $invoice = PurchaseInvoice::where('p_invoice_id', $id)->first();
        $invoice->pi_status = "Unpaid";
        $invoice->save();
    }

    public function payInvoice(Request $request)
    {

        //form data here
        $form_data = $request->input();

        //get the corresponding invoice
        $invoice = PurchaseInvoice::where('p_invoice_id', $form_data['invoice_id'])->first();

        $lastLog = PaymentInvoiceLog::orderby('id', 'desc')->first();
        $nextID = ($lastLog) ? PaymentInvoiceLog::orderby('id', 'desc')->first()->id + 1 : 1;

        //try to find the last log corresponding to the invoice and then 
        //create a description
        $last_data = PaymentInvoiceLog::where('p_invoice_id', $form_data['invoice_id'])->orderby('id', 'desc')->first();
        if($invoice->payment_mode === 'Installment') {
            if(is_null($last_data)) {
                $description = "Downpayment";
            } else {
                if(
                    in_array($last_data->payment_description, array('3rd Installment', '4th Installment', '5th Installment')) &&
                    $invoice->installment_type === '6 Months'
                ) {
                    switch($last_data->payment_description) {
                        case '3rd Installment':
                            $description = "4th ";
                            break;
                        case '4th Installment':
                            $description = "5th ";
                            break;
                        case '5th Installment':
                            $description = "6th ";
                            break;
                    }
                }
                else {
                    switch($last_data->payment_description) {
                        case 'Downpayment':
                            $description = "1st ";
                            break;
                        case '1st Installment':
                            $description = "2nd ";
                            break;
                        case '2nd Installment':
                            $description = "3rd ";
                            break;
                    }
                }
                $description .= "Installment";
            }
        } else {
            $description = "Fully Paid";
        }
        
        $data = new PaymentInvoiceLog();

        $pi_log_id = "PI-LOG-" . str_pad($nextID, 3, '0', STR_PAD_LEFT);
        $data->pi_logs_id = $pi_log_id;
        $data->p_invoice_id = $form_data['invoice_id'];
        $data->date_of_payment = $form_data['payment_date'];
        $data->payment_method = $form_data['payment_method'];
        $data->payment_description = $description;
        $data->amount_paid = $form_data['amount_paid'];
        if(
            isset($form_data['account_no']) && isset($form_data['cheque_no'])
            && isset($form_data['bank_name']) && isset($form_data['bank_location'])
        ) {
            $data->account_no = $form_data['account_no'];
            $data->cheque_no = $form_data['cheque_no'];
            $data->bank_name = $form_data['bank_name'];
            $data->bank_location = $form_data['bank_location'];
        }
        $data->save();

        $new_price = $invoice->total_amount_paid + $form_data['amount_paid'];
        $new_balance = $invoice->payment_balance - $form_data['amount_paid'];
        $invoice->total_amount_paid = $new_price;
        $invoice->payment_balance = $new_balance;
        if($description === 'Downpayment') {
            $invoice->grand_total = $new_balance;
            $invoice->total_amount_paid = 0;
        }
        if ($new_price == $invoice->grand_total) {
            $new_status = "Paid";
            $receipt = $invoice->receipt;
            if($receipt->pr_status === 'To Receive and Bill') {
                $new_pr_status = "To Receive";
            } else {
                $new_pr_status = "Completed";
                $receipt->order->supplier_quotation->archive();
            }
            $receipt->pr_status = $new_pr_status;
            $receipt->save();
            $order = $receipt->order;
            $order->mp_status = $new_pr_status;
            $order->save();
        } else {
            $new_status = "With Outstanding Balance";
        }
        $invoice->pi_status = $new_status;
        $invoice->save();
        //more logic here

    }

    public function createInvoice(Request $request)
    {
        try {

            $form_data = $request->input();

            $data = new PurchaseInvoice();

            $lastInvoice = PurchaseInvoice::orderby('id', 'desc')->first();
            $nextId = ($lastInvoice) ? $lastInvoice->id + 1 : 1;
            //$nextId = MaterialPurchased::orderby('id', 'desc')->first()->id + $to_add;

            $to_append = strlen(strval($nextId));

            $invoice_id = "PI-" . str_pad($nextId, 3, '0', STR_PAD_LEFT);

            $data->p_invoice_id = $invoice_id;
            $data->p_receipt_id = $form_data['receipt_id'];
            $data->date_created = $form_data['date_created'];
            $data->payment_mode = $form_data['payment_mode'];
            $data->grand_total = $form_data['amount'];
            $data->payment_balance = $form_data['amount'];

            if (isset($form_data['installment_type'])) {
                $data->installment_type = $form_data['installment_type'];
            }

            $data->save();
        } catch (Exception $e) {
            return $e;
        }
    }

    public function viewCheck($id) {
        $log = PaymentInvoiceLog::find($id);
        return ['acct_no' =>  $log->account_no, 'chq_no' => $log->cheque_no, 'bank_name' => $log->bank_name, 'branch' => $log->bank_location];
    }

    public function updateInvoice(Request $request) {
        try {

            $form_data = $request->input();

            $data = PurchaseInvoice::where('p_invoice_id', $form_data['invoice_id'])->first();

            $data->p_invoice_id = $form_data['invoice_id'];
            $data->date_created = $form_data['date_created'];
            $data->payment_mode = $form_data['payment_mode'];

            if (isset($form_data['installment_type'])) {
                $data->installment_type = $form_data['installment_type'];
            }

            $data->save();
        } catch (Exception $e) {
            return $e;
        }
    }
}
