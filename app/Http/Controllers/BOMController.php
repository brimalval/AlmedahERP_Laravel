<?php

namespace App\Http\Controllers;

use App\Models\BillOfMaterials;
use App\Models\ManufacturingMaterials;
use App\Models\ManufacturingProducts;
use App\Models\MaterialPurchased;
use App\Models\Routings;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class BOMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills_of_materials = BillOfMaterials::all();
        return view('modules.BOM.bom', ['boms' => $bills_of_materials]);//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $form_data = $request->input();
            $last_bom = BillOfMaterials::latest()->first();
            $next_id = $last_bom ? $last_bom->bom_id + 1 : 1;
            $bom_name = "BOM-"; //initialize "BOM-"
            //routing name ba talaga basehan? hindi product/component name?
            $product = ManufacturingProducts::where('product_code', $form_data['product_code'])->first();
            $bom_name .= $product->product_name . "-" . str_pad($next_id, 3, "0", STR_PAD_LEFT);

            $bom = new BillOfMaterials();
            $bom->product_code = $form_data['product_code'];
            $bom->routing_id = $form_data['routing_id'];
            $bom->raw_materials_rate = $form_data['rm_rates'];
            $bom->raw_material_cost = $form_data['rm_cost'];
            $bom->total_cost = $form_data['total_cost'];
            $bom->is_active = $form_data['is_active'];
            $bom->is_default = $form_data['is_default'];
            $bom->bom_name = $bom_name;

            $bom->save();
        } catch (Exception $e) {
            return $e;
        } //
    }

    public function viewBOM($bom_id) {
        $bom = BillOfMaterials::find($bom_id);
        $routing = $bom->routing;
        $product = $bom->product;
        $routing_ops = $routing->operations();
        $rateList = $bom->rateList();
        $man_prod = ManufacturingProducts::all();
        $routings = Routings::all();
        return view('modules.BOM.bominfo',
                    ['bom' => $bom, 'routing' => $routing, 'product' => $product, 'routing_ops' => $routing_ops, 'rateList' => $rateList,
                    'man_prods' => $man_prod, 'routings' => $routings]
                   );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BillsOfMaterials  $billsOfMaterials
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $bom_id)
    {
        try {
            $bom = BillOfMaterials::find($bom_id);
            $form_data = $request->input();
            $bom_name = "BOM-"; //initialize "BOM-"
            $product = ManufacturingProducts::where('product_code', $form_data['product_code'])->first();
            $bom_name .= $product->product_name . "-" . str_pad($bom_id, 3, "0", STR_PAD_LEFT);

            $bom->product_code = $form_data['product_code'];
            $bom->routing_id = $form_data['routing_id'];
            $bom->raw_materials_rate = $form_data['rm_rates'];
            $bom->raw_material_cost = $form_data['rm_cost'];
            $bom->total_cost = $form_data['total_cost'];
            $bom->is_active = $form_data['is_active'];
            $bom->is_default = $form_data['is_default'];
            $bom->bom_name = $bom_name;

            $bom->save();
        } catch (Exception $e) {
            return $e;
        } //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BillsOfMaterials  $billsOfMaterials
     * @return \Illuminate\Http\Response
     */
    public function delete($bom_id)
    {
        $bills_of_materials = BillOfMaterials::find($bom_id);
        $bills_of_materials->delete();
    }

    public function BOMForm()
    {
        $man_prod = ManufacturingProducts::all();
        $routings = Routings::all();
        return view('modules.BOM.newbom', ['man_prods' => $man_prod, 'routings' => $routings]);
    }

    public function getProduct($product_code)
    {
        try {
            DB::enableQueryLog();
            $product = ManufacturingProducts::where('product_code', $product_code)->first();
            $product_mats = $product->materials();
            $products_and_rates = array();
            foreach ($product_mats as $material) {
                $item_code = $material['material']->item_code;
                $p_order = MaterialPurchased::where('items_list_purchased', 'LIKE', "%{$item_code}%")->first();
                if ($p_order != null) {
                    $po_items = $p_order->productsAndRates($item_code);
                }
                //dd(DB::getQueryLog());
                else {
                    $po_items = array(
                        'item_code' => $material['material']->item_code,
                        'item' => ManufacturingMaterials::where('item_code', $material['material']->item_code)->first(),
                        'req_date' => date('Y-m-d'),
                        'qty' => $material['qty'],
                        'rate' => 1,
                        'subtotal' => $material['qty']
                    );
                }
                array_push(
                    $products_and_rates,
                    array(
                        'product_rates' => $po_items,
                        'qty' => $material['qty']
                    )
                );
            }
            return ["product" => $product, 'materials_info' => $products_and_rates];
        } catch (Exception $e) {
            return response()->json([
                "error" => $e->getMessage()
            ]);
        }
    }
}
