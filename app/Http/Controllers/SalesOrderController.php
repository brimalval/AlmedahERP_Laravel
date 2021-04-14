<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesOrder;
use App\Models\Customer;
use App\Models\Component;
use App\Models\WorkOrder;
use App\Models\ManufacturingProducts;
use App\Models\ManufacturingMaterials;
use App\Models\MaterialCategory;
use App\Models\MaterialPurchased;
use App\Models\payment_logs;
use App\Models\MaterialRequest;
use App\Models\ordered_products;
use DB;
use Carbon;
use Exception;
class SalesOrderController extends Controller
{
    //
    function index(){
         
        $customers = Customer::get();
        $products = ManufacturingProducts::get();

        $salesorders = DB::table('salesorder')
        ->select('salesorder.id', 'salesorder.payment_mode', 'salesorder.sales_status','salesorder.sale_supply_method' , 'salesorder.payment_balance', 'salesorder.transaction_date', 'man_customers.customer_lname', 'man_customers.customer_fname')
        ->join('man_customers','salesorder.customer_id','=','man_customers.id')
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

    function create(Request $request){
        
        function generateRandomString($length = 10) {
            return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
        }
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
            
            // Declares a 2d array because if not it considers it as a dictionary
            $converter = [ [] ];
            for ($i=0, $diff = []; $i< count($cart); $i++) {
                array_push($diff, $cart[$i]);
                if( count($diff) == 2){
                    array_push($converter, $diff);
                    $diff = [];
                }
            }
            // Pops the first empty element in the array
            array_shift($converter);
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
                $payment_logs->amount_paid = $form_data['costPrice'];
                
                $payment_logs->payment_description = "Fully Paid";

                if($form_data['paymentType'] == "Cheque"){
                    $payment_logs->payment_balance = $form_data['costPrice'];
                    $data->payment_balance = $form_data['costPrice'];
                    
                    $payment_logs->account_no = $form_data['account_no'];
                    $payment_logs->payment_status = "Pending";
                    $payment_logs->cheque_no = $form_data['cheque_no'];
                    $payment_logs->account_name = $form_data['account_name'];
                    $payment_logs->post_date_cheque = $form_data['account_cheque_date'];
                }else{
                    $payment_logs->payment_balance = 0;
                    $data->payment_balance = 0;

                    $payment_logs->payment_status = "Completed";
                }
                
            }else{
                $data->initial_payment = $form_data['saleDownpaymentCost'];
                
                $data->sales_status = "With Outstanding Balance";

                $data->installment_type = $form_data['installmentType'];
                $payment_logs->amount_paid = $form_data['saleDownpaymentCost'];

                $payment_logs->payment_description = "Downpayment";

                if($form_data['paymentType'] == "Cheque"){

                    $payment_logs->payment_balance = $form_data['costPrice'];
                    $data->payment_balance = $payment_logs->payment_balance;
                    
                    $payment_logs->account_no = $form_data['account_no'];
                    $payment_logs->payment_status = "Pending";
                    $payment_logs->cheque_no = $form_data['cheque_no'];
                    $payment_logs->account_name = $form_data['account_name'];
                    $payment_logs->post_date_cheque = $form_data['post_date_cheque'];
                }else{
                    $payment_logs->payment_balance = $form_data['costPrice'] - $form_data['saleDownpaymentCost'];
                    $data->payment_balance = $form_data['costPrice'] - $form_data['saleDownpaymentCost'];
                    $payment_logs->payment_status = "Completed";
                }
            }

            
            $payment_logs->payment_method = $form_data['paymentType'];
            

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

            $payment_logs->date_of_payment = date("Y-m-d");

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
            
            // $new_component = array();
            // $index = 1;
            // foreach(json_decode($component, true) as $key => $c){
            //     if($c[$index] == 'Component'){
            //         array_push($new_component, $c);
            //     }
            // }
 
            foreach ($cart as $row){        
                // $material_purchased = new MaterialPurchased();
                // $material_purchased->supp_quotation_id = generateRandomString();
                // $material_purchased->purchase_id = generateRandomString();
                // $material_purchased->purchase_date = date_create()->format('Y-m-d H:i:s');;   
                // $material_purchased->mp_status = "ExStatus";   
                // $material_purchased->items_list_purchased = json_encode($new_component);   
                // $material_purchased->save();

                $order = new ordered_products();
                $order->sales_id = $data->id;
                $order->product_code = $row[0];
                $order->quantity_purchased = $row[1];
                $order->save();
            }

            // foreach($new_component as $c){
            //     $work_order = new WorkOrder();
            //     $work_order->purchase_id = $material_purchased->purchase_id;
            //     $work_order->sales_id = $data->id;
            //     $work_order->planned_start_date = null;
            //     $work_order->planned_end_date = null;
            //     $work_order->real_start_date = null;
            //     $work_order->real_end_date = null;
            //     $work_order->work_order_status = "Not Started";
            //     $work_order->save();
            // }

            //return "Sucess";
            return response("Sucess");

        }catch(Exception $e){
            return $e;
        }
    }

    function getPaymentLogs($id){
        $logs = payment_logs::where('sales_id', $id)->get();
        return response($logs);
    }

    function viewId($id){
        $ordered = ordered_products::where('sales_id', $id)->get();
        return response($ordered);
    }

    function update(Request $request, $id){
        $data = payment_logs::find($id);
        $sales = salesorder::find($data->sales_id);

        $form_data = $request->input();

        if($form_data['status'] == "Pending"){
            $sales->payment_balance += $data->amount_paid;
        }else{
            $sales->payment_balance -= $data->amount_paid;
        }

        $data->payment_status = $form_data['status'];
        
        if($sales->payment_balance <= 0.00){
            $sales->sales_status = "Fully Paid";
        }else{
            $sales->sales_status = "With Outstanding Balance";
        }

        $sales->save();
        $data->save();
        
        return "Success";
    }


    function getPaymentType($id){
        //To get installment type
        $sale = salesorder::find($id);
        //Gets the last payment
        $payment = payment_logs::where('sales_id',$sale->id)->latest('id')->first();
        
        if ($sale['payment_mode'] == "Cash" || $payment['payment_balance'] == 0.00){
            return "Cash";
        }else if($payment['payment_status'] == "Pending"){
            return "Payment still pending";
        }else{

            return response( $sale['installment_type']);
        }
    }

    function getAmountToBePaid($id){
         //To get installment type
        $sale = salesorder::find($id);
        

        $installmentArr = ["3 months" => 3 , "6 months" => 6 , "12 months"=>12];

        $installmentType = $installmentArr[ $sale['installment_type']];
        $divide = ($sale['cost_price'] - $sale['initial_payment'])/$installmentType;
        return $divide;
    }

    function addPayment(Request $request){
        $data = new payment_logs;
        
        $form_data = $request->input();
        $id = $request->input('id');
        $sales = salesorder::find($id);
        //Gets the last payment
        $payment = payment_logs::where('sales_id',$id)->latest('id')->first();

        //Get current date
        $currDate = Carbon\Carbon::now();
        $currDate = $currDate->toDateString();

        $data->date_of_payment = $currDate;
        $data->sales_id = $id;
        $data->amount_paid = $form_data['view_totalamount'];
        
        if ( $form_data['view_paymentType'] == "Cheque"){
            $data->account_no = $form_data['view_account_no'];
            $data->payment_status = "Pending";
            $data->cheque_no = $form_data['view_account_no'];
            $data->account_name = $form_data['view_account_name'];
            $data->post_date_cheque = $form_data['view_post_date_cheque'];
        }else{
            $data->payment_status = "Completed";
            $sales->payment_balance = $sales->payment_balance - $form_data['view_totalamount'];
        }
        $data->payment_description = $form_data['view_salePaymentMethod'];
        $data->payment_method = $form_data['view_paymentType'];
        $data->customer_rep = $form_data['view_customer_rep'];

        $data->payment_balance = $payment['payment_balance'] - $form_data['view_totalamount'];

        if($data->payment_balance <= 0.00){
            $data->sales_status = "Fully Paid";
        }else{
            $sales->sales_status = "With Outstanding Balance";
        }

        $sales->save();
        $data->save();
    }

    function refresh(){
        $salesorders = DB::table('salesorder')
        ->select('salesorder.id', 'salesorder.payment_mode', 'salesorder.sales_status','salesorder.sale_supply_method' , 'salesorder.payment_balance', 'salesorder.transaction_date', 'man_customers.customer_lname', 'man_customers.customer_fname')
        ->join('man_customers','salesorder.customer_id','=','man_customers.id')
        ->get();

        return $salesorders;
    }

    function getCompo(Request $request){
        $products = $request->input('products');
        $qty = $request->input('qty');

        $components = array();

        for ($i=0; $i < count($products); $i++) { 

            $product = ManufacturingProducts::where('product_code', $products[$i])->first();
            $material = json_decode($product->materials, true);
            $component = json_decode($product->components, true);

            for ($x = 0; $x < count($material); $x++) {
                $material_id = $material[$x]['material_id'];
                $material_qty = $material[$x]['material_qty'];
                $raw_material = ManufacturingMaterials::where('id', $material_id)->first();
                $raw_material_name = $raw_material->item_name;
                $raw_material_category_id = $raw_material->category_id;
                $raw_material_quantity = $raw_material->rm_quantity;
                $category = MaterialCategory::where('id', $raw_material_category_id)->first();
                $raw_material_category = $category->category_title;
                array_push($components, [$material_qty * $qty[$i], $raw_material_category, $raw_material_name, $raw_material_quantity]);
            }

            for ($x = 0; $x < count($component); $x++) {
                $component_id = $component[$x]['component_id'];
                $component_qty = $component[$x]['component_qty'];
                $raw_material = Component::where('id', $component_id)->first();
                $raw_material_category = "Component";
                $raw_material_name = $raw_material->component_name;
                $raw_material_quantity = 0;
                array_push($components, [$component_qty * $qty[$i], $raw_material_category, $raw_material_name, $raw_material_quantity]);
            }
            //name, cat, neededVal, stockVal
        }

        $finalComponent = array();
        
        for ($i=0; $i < count($components); $i++) { 
            $tester = self::contains($components[$i][2] , $finalComponent);
            if( $tester == -1){
                array_push($finalComponent , $components[$i]);
            }else{
                $finalComponent[$tester][0] += $components[$i][0];
            }
        }

        return response($finalComponent);
    }

    function contains($name, $arr){
        $names = [];
        for ($i=0; $i < count($arr); $i++) { 
            array_push($names, $arr[$i][2]);
        }

        for ($i=0; $i < count($names); $i++) { 
            if( $names[$i] == $name){
                return $i;
            }
        }
        return -1;
    }   
}
