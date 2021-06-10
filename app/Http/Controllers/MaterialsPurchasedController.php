<?php

namespace App\Http\Controllers;

use App\Models\MaterialPurchased;
use App\Models\MPRecord;
use App\Models\SuppliersQuotation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Exception;
use Illuminate\Support\Facades\Validator;


class MaterialsPurchasedController extends Controller
{
    //
    public function index()
    {
        $materials_purchased = MaterialPurchased::all();
        return view('modules.buying.purchaseorder', ['materials_purchased' => $materials_purchased]);
    }

    public function openOrderForm()
    {
        $supplier_quotations = SuppliersQuotation::all();
        return view('modules.buying.newpurchaseorder', ['supplier_quotations' => $supplier_quotations]);
    }

    public function view($index)
    {
        $purchase_order = MaterialPurchased::find($index);
        //$material_requests = MaterialRequest::all();
        $quotation_supplier = $purchase_order->supplier_quotation->supplier;
        $supplier_quotations = SuppliersQuotation::all();
        $items_purchased = $purchase_order->itemsPurchased();
        $req_date = $items_purchased[0]['req_date'];
        return view(
            'modules.buying.purchaseorderinfo',
            [
                'purchase_order' => $purchase_order,
                'supplier_quotations' => $supplier_quotations,
                'items_purchased' => $items_purchased,
                'req_date' => $req_date,
                'supplier' => $quotation_supplier
            ]
        );
    }

    public function view_items($id)
    {
        $order = MaterialPurchased::find($id);
        return ['items' => $order->itemsPurchased()];
    }

    public function store(Request $request)
    {
        try {
            $data = new MaterialPurchased();

            $form_data = $request->input();

            $lastPurchase = MaterialPurchased::orderby('id', 'desc')->first();
            $nextId = ($lastPurchase) ? MaterialPurchased::orderby('id', 'desc')->first()->id + 1 : 1;
            //$nextId = MaterialPurchased::orderby('id', 'desc')->first()->id + $to_add;

            $to_append = strlen(strval($nextId));

            $purchase_id = "PUR-ORD-" . Carbon::now()->year . '-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

            $data->purchase_id = $purchase_id;

            $data->supp_quotation_id = $form_data['sq_id'];
            $data->items_list_purchased = $form_data['materials_purchased'];
            $data->purchase_date = $form_data['purchase_date'];
            $data->total_cost = $form_data['total_price'];

            $data->save();

            return ['purchase_id' => $purchase_id];
        } catch (Exception $e) {
            return $e;
        }
    }

    public function storeMaterial(Request $request)
    {
        try {
            $mp_record = new MPRecord();
            $form_data = $request->input();
            $mp_record->purchase_id = $form_data['purchase_id'];
            $mp_record->item_code = $form_data['item_code'];
            $mp_record->qty = $form_data['qty'];
            $mp_record->supplier_id = $form_data['supplier_id'];
            $mp_record->required_date = $form_data['required_date'];
            $mp_record->rate = $form_data['rate'];
            $mp_record->subtotal = $form_data['subtotal'];
            $mp_record->save();
        } catch (Exception $e) {
            return $e;
        }
    }

    public function update(Request $request)
    {
        try {
            $form_data = $request->input();

            $data = MaterialPurchased::where('purchase_id', $form_data['purchase_id'])->first();

            $data->items_list_purchased = $form_data['materials_purchased'];
            $data->purchase_date = $form_data['purchase_date'];
            $data->total_cost = $form_data['total_price'];

            $data->save();
        } catch (Exception $e) {
            return $e;
        }
    }

    public function updateStatus($purchase_id)
    {
        try {
            $data = MaterialPurchased::where('purchase_id', $purchase_id)->first();
            $data->mp_status = "To Receive and Bill";
            $data->save();
        } catch (Exception $e) {
        }
    }

    /**
     * Function is here as onDelete('cascade') does not work :(
     * Yes, maraming if statement...di kasi gumagana yung onDelete('cascade') sa akin :(
     */
    public function deleteOrder($purchase_id)
    {
        $mp_record = MaterialPurchased::where('purchase_id', $purchase_id)->first();
        //delete all records with same purchase_id 
        $material_records = $mp_record->materialRecords;
        foreach ($material_records as $material) {
            $material->delete();
        }
        //get purchase receipt and delete pending orders record related to purchase receipt
        $p_receipt = $mp_record->receipt;
        if ($p_receipt != null) {
            if ($p_receipt->pr_status === 'Draft' || $p_receipt->noReceivedMaterials() == true) {
                $order_record = $p_receipt->order_record;
                if ($order_record != null) $order_record->delete();
                $p_invoice = $p_receipt->invoice;
                if ($p_invoice != null) {
                    //get purchase invoice related to purchase receipt, and delete logs related to purchase invoice
                    $invoice_logs = $p_invoice->invoice_logs;
                    if ($invoice_logs != null) {
                        foreach ($invoice_logs as $invoice_log) {
                            $invoice_log->delete();
                        }
                    }
                    //delete invoice record
                    $p_invoice->delete();
                }
                //delete purchase receipt
                $p_receipt->delete();
            } else {
                return ['error' => 'The purchase receipt connected to this purchase order is already currently receiving materials.'];
            }
        }
        //delete purchase order
        $mp_record->delete();
    }
}
