<?php

namespace App\Http\Controllers;

use App\Models\MaterialPurchased;
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

    public function view_items($id) {
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
            $data->items_list_purchased = json_encode($form_data['materials_purchased']);
            $data->purchase_date = $form_data['purchase_date'];
            $data->total_cost = $form_data['total_price'];

            $data->save();
        } catch (Exception $e) {
            return $e;
        }
    }

    public function update(Request $request)
    {
        try {
            $form_data = $request->input();

            $data = MaterialPurchased::where('purchase_id', $form_data['purchase_id'])->first();

            $data->items_list_purchased = json_encode($form_data['materials_purchased']);
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
}
