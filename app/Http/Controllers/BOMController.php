<?php

namespace App\Http\Controllers;

use App\Models\BillOfMaterials;
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
        //
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
            $product = ManufacturingProducts::where('product_code', $product_code)->first();
            $product_mats = $product->materials();
            $products_and_rates = array();
            foreach($product_mats as $material) {
                $p_order = MaterialPurchased::where('purchase_id', 'like', '%PUR-ORD-2021-00001%')->orderby('id', 'desc')->first();
                $po_items = $p_order->itemsPurchased();
                array_push(
                    $products_and_rates,
                    array(
                        'product_rates' => $p_order->productsAndRates($material['material']->item_code),
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
