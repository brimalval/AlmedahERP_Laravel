<?php

namespace App\Http\Controllers;

use App\Models\BillsOfMaterials;
use App\Models\ManufacturingProducts;
use Illuminate\Http\Request;

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
    public function show(BillsOfMaterials $billsOfMaterials)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BillsOfMaterials  $billsOfMaterials
     * @return \Illuminate\Http\Response
     */
    public function edit(BillsOfMaterials $billsOfMaterials)
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
    public function update(Request $request, BillsOfMaterials $billsOfMaterials)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BillsOfMaterials  $billsOfMaterials
     * @return \Illuminate\Http\Response
     */
    public function destroy(BillsOfMaterials $billsOfMaterials)
    {
        //
    }

    public function BOMForm()
    {
        $man_prod = ManufacturingProducts::all();
        return view('modules.BOM.bominfo', ['man_prods' => $man_prod]);
    }

    public function getProduct($product_code)
    {
        $product = ManufacturingProducts::where('product_code', $product_code)->first();
        echo $product;
        return ['product' => $product];
    }
}
