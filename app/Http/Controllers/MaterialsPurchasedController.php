<?php

namespace App\Http\Controllers;

use App\Mail\MaterialsPurchasedMail;
use App\Models\ManufacturingMaterials;
use App\Models\MaterialPurchased;
use App\Models\MPRecord;
use App\Models\Supplier;
use App\Models\SuppliersQuotation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class MaterialsPurchasedController extends Controller
{
    //
    public function index()
    {
        $materials_purchased = MaterialPurchased::all();
        $materials = ManufacturingMaterials::all();
        $suppliers = Supplier::all();
        return view('modules.buying.purchaseorder', ['materials_purchased' => $materials_purchased, 'materials' => $materials,
                        'suppliers' => $suppliers]);
    }

    public function openOrderForm()
    {
        return view('modules.buying.newpurchaseorder', ['supplier_quotations' => SuppliersQuotation::all()]);
    }

    public function view($index)
    {
        $purchase_order = MaterialPurchased::find($index);
        $r_quotation = $purchase_order->supplier_quotation->req_quotation;
        $items_purchased = $purchase_order->itemsPurchased();
        $req_date = ($r_quotation != null) ? $r_quotation->material_request->required_date : $items_purchased[0]['req_date'];
        return view(
            'modules.buying.purchaseorderinfo',
            [
                'purchase_order' => $purchase_order,
                'supplier_quotations' => SuppliersQuotation::all(),
                'items_purchased' => $items_purchased,
                'req_date' => date_format($req_date, "Y-m-d"),
                'supplier' => $purchase_order->supplier_quotation->supplier
            ]
        );
    }

    public function getByStatus($status) {
        $order_data = MaterialPurchased::where('mp_status', $status)->get();
        return response()->json(['items' => $order_data]);
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

    public function storeMaterial(Request $request, $purchase_id)
    {

        try {
            $materials_list = $request->input();
            $item_list = json_decode($materials_list['materials_list']);
            foreach ($item_list as $item) {
                # code...
                $mp_material = new MPRecord();
                $mp_material->purchase_id = $purchase_id;
                $mp_material->item_code = $item->item_code;
                $mp_material->qty = $item->qty;
                $mp_material->supplier_id = $item->supplier_id;
                $mp_material->required_date = $item->req_date;
                $mp_material->rate = $item->rate;
                $mp_material->subtotal = $item->subtotal;
                $mp_material->save();
            }
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
            $supplier = $data->supplier_quotation->supplier;
            $mail = new MaterialsPurchasedMail($supplier, $data, 1); 
            Mail::to($supplier->supplier_email)->send($mail);
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
        $mp_material = MaterialPurchased::where('purchase_id', $purchase_id)->first();
        //delete all records with same purchase_id 
        $mp_records = MPRecord::where('purchase_id', $purchase_id)->get();
        if($mp_records != null) $mp_records->delete();
        //get purchase receipt and delete pending orders record related to purchase receipt
        $p_receipt = $mp_material->receipt;
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
        //cancel purchase order
        $mp_material->mp_status = 'Cancelled';
        $mp_material->save();

        $supplier = $mp_material->supplier_quotation->supplier;
        $mail = new MaterialsPurchasedMail($supplier, $mp_material, 0); 
        Mail::to($supplier->supplier_email)->send($mail);
    }
}