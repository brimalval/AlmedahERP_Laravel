<?php

namespace App\Http\Controllers;

use App\Models\MaterialPurchased;
use App\Models\PurchaseInvoice;
use App\Models\PurchaseReceipt;
use App\Models\SuppliersQuotation;
use Illuminate\Http\Request;
use DB;
use Exception;

class PurchaseInvoiceController extends Controller
{
    //
    public function index() {
        $purchase_invoice = PurchaseInvoice::all();
        return view('modules.buying.purchaseinvoice', ['invoices' => $purchase_invoice]);
    }

    public function openInvoiceForm() {
        $receipts = PurchaseReceipt::where('pr_status', 'To Bill')->get();
        return view('modules.buying.newPurchaseInvoice', ['receipts' => $receipts]);
    }

    public function viewInvoice($id) {
        $invoice = PurchaseInvoice::find($id);
        $receipt = PurchaseReceipt::where('p_receipt_id', $invoice->p_receipt_id)->first();
        $received_items = $receipt->receivedMats();
        $order = MaterialPurchased::where('purchase_id', $receipt->purchase_id)->first();
        $supplier = SuppliersQuotation::where('supp_quotation_id', $order->supp_quotation_id)->first()->supplier;
        return view('modules.buying.purchaseInvoiceInfo', ['invoice' => $invoice, 'received_items' => $received_items, 'supplier' => $supplier]);
    }

    public function payInvoice($id) {
        $invoice = PurchaseInvoice::where('p_invoice_id', $id)->first();
        $invoice->pi_status = "Paid";
        $invoice->save();

        $receipt = PurchaseReceipt::where('p_receipt_id', $invoice->p_receipt_id)->first();
        $receipt->pr_status = "Completed";
        $receipt->save();
        $order = MaterialPurchased::where('purchase_id', $receipt->purchase_id)->first();
        $order->mp_status = "Completed";
        $order->save();
    }

    public function createInvoice(Request $request) {
        try {

            $form_data = $request->input();

            $data = new PurchaseInvoice();

            $lastInvoice = PurchaseInvoice::orderby('id', 'desc')->first();
            $nextId = ($lastInvoice) ? $lastInvoice->id + 1 : 1;
            //$nextId = MaterialPurchased::orderby('id', 'desc')->first()->id + $to_add;

            $to_append = 0;
            $digit_flag = 1;
            while ($nextId >= $digit_flag) {
                ++$to_append;
                $digit_flag *= 10;
            }

            $invoice_id = "PI-" . str_pad($nextId, 3 - $to_append, '0', STR_PAD_LEFT);

            $data->p_invoice_id = $invoice_id;
            $data->p_receipt_id = $form_data['receipt_id'];
            $data->date_created = $form_data['date_created'];
            $data->due_date_of_payment = $form_data['due_date'];
            $data->mode_payment = $form_data['payment_mode'];
            $data->paid_amount = $form_data['amount'];

            $data->save();
        } catch (Exception $e) {
            return $e;
        }
    }
}
