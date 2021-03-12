<?php

namespace App\Http\Controllers;

use App\Models\ProductMonitoring;
use Exception;
use Illuminate\Http\Request;

class ProductMonitoringController extends Controller
{
    public function index(){
        $monitoring_rows = ProductMonitoring::with('product')->get();
        return view('modules.manufacturing.productmonitoring', [
            'monitoring_rows' => $monitoring_rows,
        ]);
    }

    public function store(Request $request){

        // Validation rules
        $rules = [
            // REMEMBER TO ADD FOREIGN KEY VALIDATION RULES TO THESE FIELDS
            "customer_id" => "required|integer|numeric",
            "product_code" => "required|alpha_dash",
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
                'message' => $e->getMessage(),
            ]);
        }
    }
}
