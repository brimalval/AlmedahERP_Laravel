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
        //$bills_of_materials = BillsOfMaterials::all();
        //return view('modules.BOM.routing', ['bom' => $bills_of_materials]);//
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $next_id = $last_bom ? $last_bom->id + 1 : 1;
            $bom_name = "BOM-"; //initialize "BOM-"
            $bom_label = $form_data['routingSelect'];
            $words = explode(' ', $bom_label);
            $bom_name .= strtoupper($words[0])."-". str_pad($next_id, 3, "0", STR_PAD_LEFT);

            $bills_of_materials = new BillOfMaterials();
            $bills_of_materials->product_code = $form_data['manprod'];
            $bills_of_materials->routing_id = $form_data['routingSelect'];
            $bills_of_materials->raw_materials_rate = $form_data['manprod'];
        } catch (Exception $e) {
            return $e;
        }//
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BillsOfMaterials  $billsOfMaterials
     * @return \Illuminate\Http\Response
     */
    public function show(BillOfMaterials $billsOfMaterials)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BillsOfMaterials  $billsOfMaterials
     * @return \Illuminate\Http\Response
     */
    public function edit(BillOfMaterials $billsOfMaterials)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BillsOfMaterials  $billsOfMaterials
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BillOfMaterials $billsOfMaterials)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BillsOfMaterials  $billsOfMaterials
     * @return \Illuminate\Http\Response
     */
    public function destroy(BillOfMaterials $billsOfMaterials)
    {
        //
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
            foreach($product_mats as $material) {
                $item_code = $material['material']->item_code;
                $p_order = MaterialPurchased::where('items_list_purchased', 'LIKE', "%{$item_code}%")->first();
                if($p_order != null) {
                    $po_items = $p_order->productsAndRates($item_code);
                }
                //dd(DB::getQueryLog());
                else{
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
