<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesOrder;
use App\Models\Customer;
use App\Models\ManufacturingProducts;
use App\Models\ManufacturingMaterials;
use App\Models\MaterialCategory;
use DB;
use Exception;
class SalesOrderController extends Controller
{
    //
    function index(){
        $salesorders = SalesOrder::get();
        $customers = Customer::get();
        $products = ManufacturingProducts::get();
        return view('modules.selling.salesorder', ['sales' =>$salesorders , 'customers'=> $customers, 'products'=> $products]);
    }

    function get($sales_order_id) {
        $sales_order = SalesOrder::find($sales_order_id);
        $product = ManufacturingProducts::where('product_code', $sales_order->product_code)->first();
        $customer_info = Customer::find($sales_order->customer_id);
        return view('modules.selling.saleInfo', 
        ['sales_order' => $sales_order, 'product' => $product, 'customer' => $customer_info]);
    }

    function getComponents($selected){
        $product = ManufacturingProducts::where('product_code', $selected)->first();
        $material = json_decode($product->materials, true);
        $components = array();
        for ($x = 0; $x < count($material); $x++) {
            $material_id = $material[$x]['material_id'];
            $material_qty = $material[$x]['material_qty'];
            $raw_material = ManufacturingMaterials::where('id', $material_id)->first();
            $raw_material_name = $raw_material->item_name;
            $raw_material_category_id = $raw_material->category_id;
            $category = MaterialCategory::where('id', $raw_material_category_id)->first();
            $raw_material_category = $category->category_title;
            array_push($components, [$material_qty, $raw_material_category, $raw_material_name]);
        }
        return response($components);
    }

    function create(Request $request){

        #Comment ko muna yung validation, nahihirapan akong mag-enter ng data para sa testing eh hahah
        //$request->validate([
        //    'costPrice' => 'nullable|numeric',
        //    'saleCurrency' => 'nullable|alpha_dash',
        //    'saleSupplyMethod' => 'nullable|alpha_dash',
        //    
        //    'saleQuantity' => 'required|numeric|min:1',
        //    'saleStockUnit' => 'required|alpha_dash',
        //    'productLaunchDate' => 'required|date',
        //    'productPulledMarket' => 'required|date',
        //    'saleDate' => 'required|date',
        //    'salePaymentMethod' => 'required|alpha_dash',
//
        //    'saleProductCode' => 'required|alpha_dash',
        //    'saleQuantity' => 'required|numeric|min:1',
        //    'salesUnit' => 'required|alpha_dash',
        //    
        //    # initial_payment
        //    'saleDownpaymentCost' => 'nullable|numeric',
        //    
        //    'customer_id' => 'nullable|numeric',
        //    'lName' => 'required|alpha_dash',
        //    'fName' => 'required|alpha_dash',
        //    'branchName' => 'required|alpha_dash',
        //    'contactNum' => 'required|alpha_dash',
        //    'custAddress' => 'required|alpha_dash',
        //    'custEmail' => 'required|alpha_dash',
        //    'companyName' => 'required|alpha_dash',
        //]);

        try{

            $form_data = $request->input();

            $data = new SalesOrder();
            $data->cost_price = $form_data['costPrice'];
            $data->sale_supply_method = $form_data['saleSupplyMethod'];
            $data->sale_currency = $form_data['saleCurrency'];
            $data->quantity = 1;
            $data->stock_unit = 'kg';
            //$data->product_launch_date = $form_data['productLaunchDate'];
            $data->product_pulled_off_market = $form_data['productPulledMarket'];
            $data->date = $form_data['saleDate'];
            $data->product_code = $form_data['saleProductCode'];
            $data->sales_unit = $form_data['salesUnit'];
            //Payment method if installment has an initialpayment
            $data->payment_mode = $form_data['salePaymentMethod'];
            

            //Calculate total cost of material then minus initial payment or full payment
            // @TODO Balanced out to zero if full payment
            if($form_data['salePaymentMethod'] == "Full Payment(Cash)"){
                $data->payment_balance = 0;
            }else{
                $data->initial_payment = $form_data['saleDownpaymentCost'];
                // $product_price = ManufacturingProducts::where('product_code', '=', request('saleProductCode'))->first();
                //$data->payment_balance = ($form_data['costPrice'] * $form_data['saleQuantity']) - $data->initial_payment;
                //Calculate payment track. I think should be in json
                // @TODO Json File
                $data->payment_track = NULL;
                //Payment status. Complete, in bank, etc
                $data->payment_status = "Waiting for approval";
                $data->installment_type = $form_data['installmentType'];
            }
            //Ship, shipped, in assembly, waiting for payment, or completed.  
            $data->sales_status = "Waiting for Assembly";


            $customerCheck = Customer::where('id', "=", request('customer_id'))->first();
            if(!$customerCheck){
                $customerCheck = new Customer();
                $customerCheck->customer_lname = $form_data['lName'];
                $customerCheck->customer_fname = $form_data['fName'];
                $customerCheck->branch_name = $form_data['branchName'];
                $customerCheck->contact_number = $form_data['contactNum'];
                $customerCheck->address = $form_data['custAddress'];
                $customerCheck->email_address = $form_data['custEmail'];
                $customerCheck->company_name = $form_data['companyName'];
                $customerCheck->save();
                #Get id
                $data->customer_id = $customerCheck->id;
                
            }else{
                $data->customer_id = $form_data['customer_id'];
            }
            $data->save();

            return SalesOrder::where('id', "=", $data->id)->first();

        }catch(Exception $e){
            return $e;
        }
    }
}
