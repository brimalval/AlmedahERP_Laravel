<?php

namespace App\Http\Controllers;

use App\Models\ProductMonitoring;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductMonitoringController extends Controller
{
    /**
     * Instantiate a ProductMonitoringController.
     * NOTE: in the future, attach middleware for distinguishing
     * between admins and users
     * 
     * e.g. $this->middleware('admin', ['except'=>['index', 'show']])
     */
    public function __construct()
    {
    }

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
        try {
            $formdata = $request->input();
            $row = new ProductMonitoring($formdata);
            $row->save();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductMonitoring  $productmonitoring
     * @return \Illuminate\Http\Response
     */
    public function show(ProductMonitoring $productmonitoring)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductMonitoring  $productmonitoring
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductMonitoring $productmonitoring)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductMonitoring  $productmonitoring
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductMonitoring $productmonitoring)
    {
        $rules = [
            'product_code' => 'nullable|string|exists:man_products',
            // UPDATE RULES WITH TABLE NAMES HERE
            'customer_id' => 'nullable|numeric|integer',
            'station_id' => 'nullable|string',
            // ###########################
            'planned_start_date' => 'nullable|date',
            'planned_end_date' => 'nullable|date',
            'real_start_date' => 'nullable|date',
            'real_end_date' => 'nullable|date',
            'pm_status' => 'nullable|string',
        ];

        // Automatically returns array of error messages if it fails
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ]);
        }

        try {
            // Removing empty fields
            $filtered_request = array_filter($request->all());
            $productmonitoring->update($filtered_request);
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully updated the monitoring entry',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductMonitoring  $productmonitoring
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductMonitoring $productmonitoring)
    {
        try {
            $productmonitoring->delete();
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
