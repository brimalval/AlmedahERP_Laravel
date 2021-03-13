<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;

class SalesOrderController extends Controller
{
    //
    function index(){
        $salesorders = Sales::get();
        return view('modules.selling.salesorder', ['sales' =>$salesorders]);
    }

    function store(Request $request){
        $request->validate([
            'material_code' => 'required|alpha_dash',
            'material_name' => 'required|alpha_dash',
            'material_category' => 'required|alpha_dash',
            'unit_price' => 'required|integer|numeric|min:0',
            'total_amount' => 'required|integer|numeric|min:1',
            'rm_status' => 'required',
            'material_image' => 'required',
            'material_image.*' => 'image' 
        ]);

        try{
            $form_data = $request->input();
            $data = Customer::where('id', "=", request('customer_id'))->first();
            if(!$data){
                $data = new Customer();
                $data->customer_lname = $form_data['lName'];
                $data->customer_fname = $form_data['fName'];
                $data->branch_name = $form_data['branchName'];
                $data->contact_number = $form_data['contactNum'];
                $data->address = $form_data['custAddress'];
                $data->email_address = $form_data['custEmail'];
                $data->company_name = $form_data['companyName'];
                $data->save();
            }
            $data = new Sales();
            $data->customer_id = $form_data['salesId'];
            $data->cost_price = $form_data['costPrice'];
            $data->sale_supply_method = $form_data['saleSupplyMethod'];
            $data->quantity = $form_data['saleQuantity'];
            $data->stock_unit = $form_data['saleStockUnit'];
            $data->product_launch_date = $form_data['productLaunchDate'];
            $data->product_pulled_off_market = $form_data['productPulledMarket'];
            $data->date = $form_data['saleDate'];
            $data->unrenewed = $form_data['saleUnrenewed'];
            $data->version = $form_data['saleVersion'];
            $data->description = $form_data['saleDescription'];
            $data->product_code = $form_data['saleProductCode'];
            $data->sales_unit = $form_data['salesUnit'];
            //Payment method if installment has a initialpayment
            $data->payment_mode = $form_data['salePaymentMethod'];
            $data->initial_payment = $form_data['saleDownpaymentCost'];

            //Calculate total cost of material then minus initial payment or full payment
            $data->payment_balance = 1+1;
            //Calculate payment track. I think should be in json
            $data->payment_track = "First payment: 500" + "Second Payment: 600";
            //Payment status. Complete, in bank, etc
            $data->payment_status = "Complete";
            //ship, shipped, in assembly, waiting for payment, or completed.  
            $data->sales_status = "Assembly";

        }catch(Exception $e){
            return $e;
        }
    }
}
