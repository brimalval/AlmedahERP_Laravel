<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use DB;
use Exception;

class SalesOrderController extends Controller
{
    //
    function find_customer(Request $request) {
        try {
            $customer_id = $request->input();
            $data = Customer::find($customer_id); 
            return response()->json([
                'customer_data' => $data
            ]);
        } catch(Exception $e) {
            return $e;
        }
    }
}
