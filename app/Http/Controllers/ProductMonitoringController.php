<?php

namespace App\Http\Controllers;

use App\Models\ProductMonitoring;
use Exception;
use Illuminate\Http\Request;

class ProductMonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monitoring_rows = ProductMonitoring::with('product')->get();
        return view('modules.manufacturing.productmonitoring', [
            'monitoring_rows' => $monitoring_rows,
        ]);
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
        // Validation rules
        $rules = [
            // Identifies whether the specified product_code exists in the
            // product_code column of man_products
            "product_code" => "required|alpha_dash|exists:man_products",
            // REMEMBER TO ADD FOREIGN KEY VALIDATION RULES TO THESE FIELDS
            "customer_id" => "required|integer|numeric",
            "station_id" => "required|integer|numeric",
            // ############################################################
            "planned_start_date" => "required|date",
            "planned_end_date" => "required|date",
            "real_start_date" => "required|date", 
            "real_end_date" => "required|date",
        ];

        // Validating the request with the rules above
        $request->validate($rules);

        // Attempting to store the information in the product_monitoring table
        try{
            $formdata = $request->input(); 
            $row = new ProductMonitoring($formdata);
            $row->save();
            return response()->json([
                'status' => 'success'
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e,
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductMonitoring  $productMonitoring
     * @return \Illuminate\Http\Response
     */
    public function show(ProductMonitoring $productMonitoring)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductMonitoring  $productMonitoring
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductMonitoring $productMonitoring)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductMonitoring  $productMonitoring
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductMonitoring $productMonitoring)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductMonitoring  $productMonitoring
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductMonitoring $productMonitoring)
    {
        //
    }
}
