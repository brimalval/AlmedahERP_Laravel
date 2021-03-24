<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesOrder;
use App\Models\Customer;
use App\Models\ManufacturingProducts;
use App\Models\ManufacturingMaterials;
use App\Models\MaterialCategory;
use App\Models\payment_logs;
use App\Models\MaterialRequest;
use App\Models\ordered_products;
use DB;
use Exception;
class SalesOrderController extends Controller
{
    //
    function index(){
         
        $customers = Customer::get();
        $products = ManufacturingProducts::get();

        $salesorders = DB::table('salesorder')
        ->select('*')
        ->join('payment_logs','payment_logs.sales_id','=','salesorder.id')
        ->join('ordered_products', 'ordered_products.sales_id', '=', 'salesorder.id')
        ->get();

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
        //    'saleDate' => 'required|date',
        //    'saleSupplyMethod' => 'nullable|alpha_dash',
        //    'salePaymentMethod' => 'required|alpha_dash',
        //    'saleDownpaymentCost' => 'nullable|numeric',
        //    'installmentType' => 'nullable|alpha_dash',

        //    'saleCurrency' => 'nullable|alpha_dash',
       
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

            $cart = $request->input("cart");
            $cart = explode(',', $cart);
            
            $converter = [];
            for ($i=0, $diff = []; $i< count($cart); $i++) {
                if( count($diff) == 2){
                    array_push($converter, $diff);
                }else{
                    array_push($diff, $cart[$i]);
                }
                
            }
            $cart = $converter;
            
            $component = $request->input("component");
            
            $data = new SalesOrder();
            $data->cost_price = $form_data['costPrice'];
            $data->sale_supply_method = $form_data['saleSupplyMethod'];


            $data->transaction_date = $form_data['saleDate'];

            //Payment method if installment has an initialpayment
            $data->payment_mode = $form_data['salePaymentMethod'];
            
            $payment_logs = new payment_logs();
            $payment_logs->date_of_payment = $form_data['saleDate'];

            //Calculate total cost of material then minus initial payment or full payment
            // @TODO Balanced out to zero if full payment
            if($form_data['salePaymentMethod'] == "Cash"){
                $data->sales_status = "Fully Paid";
                $payment_logs->payment_balance = 0;
                $payment_logs->amount_paid = $form_data['costPrice'];

                #@TODO
                $payment_logs->payment_description = "To be developed";
                
            }else{
                $data->initial_payment = $form_data['saleDownpaymentCost'];
                
                $payment_logs->payment_balance = $form_data['costPrice'] - $form_data['saleDownpaymentCost'];

                $data->sales_status = "With Outstanding Balance";

                $data->installment_type = $form_data['installmentType'];
                $payment_logs->amount_paid = $form_data['saleDownPaymentCost'];

                #@TODO
                $payment_logs->payment_description = "To be developed";
                
            }

            if($form_data['paymentType'] == "Cheque"){
                $payment_logs->account_no = $form_data['account_no'];
            }
            $payment_logs->payment_method = $form_data['salePaymentMethod'];
            $payment_logs->payment_status = "Pending";
            //Ship, shipped, in assembly, waiting for payment, or completed.  

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
                $data->customer_id = $form_data['customer_id'] ;
            }
            //Concat method lmao
            $payment_logs->customer_rep = $form_data['lName'] . " ". $form_data['fName'];
            
            $data->save();
            $payment_logs->sales_id = $data->id;
            $payment_logs->save();
            
            // MATERIAL REQUEST CANNOT CONTINUE DUE TO LACK OF INFO
            // if ($form_data['saleSupplyMethod'] == "Purchase"){
            //     foreach ($component as $row){
            //         $mat_req = new MaterialRequest();
            //         $mat_req->request_date = $form_data['saleDate'];
            //         // Should have input from sales order
            //         $mat_req->required_date = $form_data['saleDate'];
            //         $purpose->purpose = $data->id;
            //         $mr_status = "Draft";
            //     }
            // }

            foreach ($cart as $row){

                $order = new ordered_products();
                $order->sales_id = $data->id;
                $order->product_code = $row[0];
                $order->quantity_purchased = $row[1];
                
                $order->save();
            }
            
            return "Sucess";

        }catch(Exception $e){
            return $e;
        }
    }
}
