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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $materials_purchased = MaterialPurchased::all();
        $materials = ManufacturingMaterials::all();
        $suppliers = Supplier::all();
        return view('modules.buying.purchaseorder', 
                    ['materials_purchased' => $materials_purchased, 
                     'materials' => $materials,
                     'suppliers' => $suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('modules.buying.newpurchaseorder', ['supplier_quotations' => SuppliersQuotation::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            $data = new MaterialPurchased();

            $form_data = $request->input();
            $items_string = $form_data['materials_purchased'];

            $lastPurchase = MaterialPurchased::orderby('id', 'desc')->first();
            $nextId = ($lastPurchase) ? MaterialPurchased::orderby('id', 'desc')->first()->id + 1 : 1;
            //$nextId = MaterialPurchased::orderby('id', 'desc')->first()->id + $to_add;

            $purchase_id = "PURCH" . Carbon::now()->year . str_pad($nextId, 5, '0', STR_PAD_LEFT);

            $data->purchase_id = $purchase_id;

            $data->supp_quotation_id = $form_data['sq_id'];
            $data->items_list_purchased = $items_string;
            $data->purchase_date = $form_data['purchase_date'];
            $data->total_cost = $form_data['total_price'];

            $data->save();

            $item_list = json_decode($items_string);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $purchase_order = MaterialPurchased::find($id);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    public function updateOrder(Request $request)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $mp_material = MaterialPurchased::where('purchase_id', $id)->first();
        //delete all records with same purchase_id 
        $material_records = $mp_material->materialRecords;
        foreach ($material_records as $material) {
            $material->delete();
        }
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
                return ['error' => 'Cannot cancel this order. Some of the items listed have already been delivered.'];
            }
        }
        //cancel purchase order
        $mp_material->mp_status = 'Cancelled';
        $mp_material->save();

        $supplier = $mp_material->supplier_quotation->supplier;
        $mail = new MaterialsPurchasedMail($supplier, $mp_material, 0); 
        Mail::to($supplier->supplier_email)->send($mail);
    }

    public function view_items($id)
    {
        $order = MaterialPurchased::find($id);
        return ['items' => $order->itemsPurchased()];
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

    public function filterBy($filter, $value) {
        $order_data = null;
        if($filter !== 'all') {
            if($filter !== 'mp_status') {
                $filter = 'items_list_purchased';
                $value = '%'.$value.'%';
                $order_data = MaterialPurchased::where($filter, 'LIKE', $value)->get();
            }
            else
                $order_data = MaterialPurchased::where($filter, $value)->get();
        }
        else $order_data = MaterialPurchased::all();
        return response()->json(['items' => $order_data]);
    }
}
