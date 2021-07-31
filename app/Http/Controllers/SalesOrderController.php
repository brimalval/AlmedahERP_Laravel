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
use Illuminate\Support\Carbon;
use DB;
use Exception;
use \stdClass;
class SalesOrderController extends Controller
{
    //
    function index(){
         
        $customers = Customer::get();
        $products = ManufacturingProducts::get();

        $salesorders = DB::table('salesorder')
        ->select('salesorder.id', 'salesorder.payment_mode', 'salesorder.sales_status', 'salesorder.payment_balance', 'salesorder.transaction_date', 'man_customers.customer_lname', 'man_customers.customer_fname')
        ->join('man_customers','salesorder.customer_id','=','man_customers.id')
        ->get();

        return view('modules.selling.salesorder', ['sales' =>$salesorders , 'customers'=> $customers, 'products'=> $products]);
    }

    function loadProducts(){
        $products = ManufacturingProducts::get();
        return $products;
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
        // $request->validate([
        //     'costPrice' => 'required|numeric|gt:0',
        //     'saleDate' => 'required|date',
        //     'saleSupplyMethod' => 'required|alpha_dash',
        //     'salePaymentMethod' => 'required|alpha_dash',
        //     'saleDownpaymentCost' => 'nullable|numeric|gt:0',
        //     'installmentType' => 'nullable|alpha_dash',
        //     'paymentType' => 'nullable|alpha',
       
            
        //     'customer_id' => 'nullable|numeric',
        //     'lName' => 'required|alpha_dash',
        //     'fName' => 'required|alpha_dash',
        //     'branchName' => 'required|alpha_dash',
        //     'contactNum' => 'required|alpha_dash',
        //     'custAddress' => 'required|alpha_dash',
        //     'custEmail' => 'required|alpha_dash',
        //     'companyName' => 'required|alpha_dash',

        //     'account_no' => 'nullable|alpha_dash',
        //     'cheque_no' => 'nullable|alpha_dash',
        //     'account_name' => 'nullable|alpha_dash',
        //     'bank_name' => 'nullable|alpha_dash',
        //     'branch_location' => 'nullable|alpha_dash',
        //     'account_name' => 'nullable|alpha',
        // ]);

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
                    $payment_logs->bank_name = $form_data['bank_name'];
                    $payment_logs->branch_location = $form_data['branch_location'];
                }else{
                    $payment_logs->payment_balance = 0;
                    $data->payment_balance = 0;

                    $payment_logs->payment_status = "Completed";
                }
                
            }else{
                $data->initial_payment = $form_data['saleDownpaymentCost'];
                
                $data->sales_status = "With Outstanding Balance";

                if(isset($form_data['installmentType'])) {
                    $data->installment_type = $form_data['installmentType'];
                }
                
                $payment_logs->amount_paid = $form_data['saleDownpaymentCost'];

                $payment_logs->payment_description = "Downpayment";

                if($form_data['paymentType'] == "Cheque"){

                    $payment_logs->payment_balance = $form_data['costPrice'];
                    $data->payment_balance = $payment_logs->payment_balance;
                    
                    $payment_logs->account_no = $form_data['account_no'];
                    $payment_logs->payment_status = "Pending";
                    $payment_logs->cheque_no = $form_data['cheque_no'];
                    $payment_logs->account_name = $form_data['account_name'];
                    $payment_logs->bank_name = $form_data['bank_name'];
                    $payment_logs->branch_location = $form_data['branch_location'];
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
                $customerCheck->profile_picture = "";
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
            
            $new_component = array();
            foreach(json_decode($component, true) as $c){
                array_push($new_component, $c);
            }
 
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
                
                
                $prod = ManufacturingProducts::where('product_code', $row[0])->first();
                if( $prod->stock_unit - $row[1] > 0){
                    $prod->stock_unit = $prod->stock_unit - $row[1];
                }else{
                    $prod->stock_unit = 0;
                }
                $prod->save();
            }

            $work_order_ids = array();
            $componentMaterials = json_decode($request->input("componentMaterials"), true);
            $productMaterials = json_decode($request->input("productMaterials"), true);
            foreach ($cart as $i=>$row){ 

                $work_order = new WorkOrder();
                $work_order->product_code = $row[0];
                $work_order->mat_ordered_id = null;
                $work_order->sales_id = $data->id;
                $work_order->planned_start_date = null;
                $work_order->planned_end_date = null;
                $work_order->real_start_date = null;
                $work_order->real_end_date = null;
                $work_order->work_order_status = "Pending";
                $work_order->work_order_no = "WOK";
                $work_order->transferred_qty = json_encode($productMaterials[$i]);
                $work_order->save();
                $won = "WOR-PR-".Carbon::now()->year."-".str_pad($work_order->id, 5, '0', STR_PAD_LEFT);
                $work_order->work_order_no = $won;
                $work_order->save();
                array_push($work_order_ids, $work_order->id);
            }

            foreach($new_component as $i=>$c){
                $component_name = $c['component_name'];
                $component = Component::where('component_name', "=", $component_name)->first();
                $component_code = $component->component_code;
                $work_order = new WorkOrder();
                $work_order->component_code = $component_code;
                $work_order->mat_ordered_id = null;
                $work_order->sales_id = $data->id;
                $work_order->planned_start_date = null;
                $work_order->planned_end_date = null;
                $work_order->real_start_date = null;
                $work_order->real_end_date = null;
                $work_order->work_order_status = "Pending";
                $work_order->work_order_no = "WOK";
                $work_order->transferred_qty = json_encode($componentMaterials[$i]);
                $work_order->save();
                $won = "WOR-CO-".Carbon::now()->year."-".str_pad($work_order->id, 5, '0', STR_PAD_LEFT);
                $work_order->work_order_no = $won;
                $work_order->save();
                array_push($work_order_ids, $work_order->id);
            }

            //return "Sucess";
            return response(json_encode($work_order_ids));
            // return response($work_order->id);

        }catch(Exception $e){
            return $e;
        }
    }

    function returnProductComponentMaterials(Request $request){
        $createMatRequestItems = json_decode($request->input("cmri"), true);
        $rawMaterialsOnly = json_decode($request->input("rmo"), true);
        $materialsInComponents = json_decode($request->input("mic"), true);
        $workOrderCompElements = json_decode($request->input("woce"), true);
        $workOrderComp = json_decode($request->input("woc"), true);
        $workOrderProdElements = json_decode($request->input("wope"), true);
        $workOrderProd = json_decode($request->input("wop"), true);
        if(count($createMatRequestItems) != 0){
            foreach($createMatRequestItems as $matReqItem){
                $woe = new stdClass();
                $woe->item_code = $matReqItem['item_code'];
                $woe->transferred_qty = $matReqItem['quantity_needed_for_request'];
                $woe->quantity_avail = $matReqItem['quantity_avail'];
                $woe->status = 'Pending';
                $woe->product_code = $matReqItem['product_code'];

                $obj = new stdClass();
                $product_code = $matReqItem['product_code'];
                $obj->$product_code = '';
                
                if($matReqItem['category'] === 'Component'){
                    array_push($workOrderCompElements, $woe);
                    $exist = false;
                    foreach($workOrderComp as $wocEl){
                        if(key($wocEl) === $product_code){
                            $exist = true;
                        }
                    }
                    if(!$exist){
                        array_push($workOrderComp, $obj);
                    }
                }else{
                    array_push($workOrderProdElements, $woe);
                    $exist = false;
                    foreach($workOrderProd as $wopEl){
                        if(key($wopEl) === $product_code){
                            $exist = true;
                        }
                    }
                    if(!$exist){
                        array_push($workOrderProd, $obj);
                    }
                }
            }

            if(count($createMatRequestItems) != count($rawMaterialsOnly) + count($materialsInComponents)){
                foreach($rawMaterialsOnly as $rawMat){
                    $exist = false;
                    foreach($workOrderProdElements as $wopEl){
                        if($wopEl['item_code'] == $rawMat['item_code'] && $wopEl['product_code'] == $rawMat['product_code']){
                            $exist = true;
                        }
                    }
                    if(!exist){
                        $woe = new stdClass();
                        $woe->item_code = $rawMat['item_code'];
                        $woe->transferred_qty = $rawMat['quantity_avail'];
                        $woe->quantity_avail = $rawMat['quantity_avail'];
                        $woe->status = "pending";
                        $woe->product_code = $rawMat['product_code'];
                        $obj = new stdClass();
                        $product_code = $rawMat['product_code'];
                        $obj->$product_code = "";
                        array_push($workOrderProdElements, $woe);
                        $exist2 = false;
                        foreach($workOrderProdElements as $wopeEl){
                            if(key($wopeEl) === $product_code){
                                $exist2 = true;
                            } 
                        }
                        if(!$exist2){
                            array_push($workOrderProd, $obj);
                        }
                    }
                }

                foreach($materialsInComponents as $matComp){
                    $exist = false;
                    foreach($workOrderCompElements as $wocEl){
                        if($wocEl['item_code'] == $matComp['item_code'] && $wocEl['product_code'] == $matComp['product_code']){
                            $exist = true;
                        }
                    }
                    if(!$exist){
                        $woe = new stdClass();
                        $woe->item_code = $matComp['item_code'];
                        $woe->transferred_qty = $matComp['quantity_avail'];
                        $woe->quantity_avail = $matComp['quantity_avail'];
                        $woe->status = "pending";
                        $woe->product_code = $matComp['product_code'];
                        $obj = new stdClass();
                        $product_code = $matComp['product_code'];
                        $obj->$product_code = "";
                        array_push($workOrderCompElements, $woe);
                        $exist2 = false;
                        foreach($workOrderCompElements as $woceEl){
                            if(key($woceEl) === $product_code){
                                $exist2 = true;
                            } 
                        }
                        if(!$exist2){
                            array_push($workOrderComp, $obj);
                        }
                    }
                }


            }

        }else{
            foreach($rawMaterialsOnly as $rawMat){
                $woe = new stdClass();
                $woe->item_code = $rawMat['item_code'];
                $woe->transferred_qty = $rawMat['quantity_avail'];
                $woe->quantity_avail = $rawMat['quantity_avail'];
                $woe->status = "pending";
                $woe->product_code = $rawMat['product_code'];
                array_push($workOrderProdElements, $woe);
            }

            foreach($materialsInComponents as $matComp){
                $woe = new stdClass();
                $woe->item_code = $matComp['item_code'];
                $woe->transferred_qty = $matComp['quantity_avail'];
                $woe->quantity_avail = $matComp['quantity_avail'];
                $woe->status = "pending";
                $woe->product_code = $matComp['product_code'];
                array_push($workOrderCompElements, $woe);
            }
        }

    
        return response()->json(['workOrderComp'=>$workOrderComp, 'workOrderProd'=>$workOrderProd, 
                                 'workOrderCompElements'=>$workOrderCompElements, 'workOrderProdElements'=>$workOrderProdElements]);
    }

    function getRawMaterialQuantitySales($raw_material){
        $raw_material = ManufacturingMaterials::where('item_name', $raw_material)->first();
        $raw_material_qty = $raw_material->rm_quantity;
        return response($raw_material_qty);
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
        $validator = $request->validate([
            'costPrice' => 'required|numeric|gt:0',
        ]);
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
        if ($sale['payment_mode'] == "Cash" || $sale['payment_balance'] == 0.00){
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

        $request->validate([
            'view_totalamount' => 'required|numeric|gt:0',
            'view_paymentType' => 'required|alpha_dash',
            'view_account_no' => 'required',
            'view_cheque_no' => 'required|alpha_dash',
            'view_account_name' => 'nullable',
            'view_bank_name' => 'nullable',
            'view_branch_location' => 'nullable',
       
            
            'view_totalamount' => 'required|numeric|gt:0',
            'view_salePaymentMethod' => 'required|numeric',
            'view_paymentType' => 'required|alpha',
            'view_customer_rep' => 'required',
            'view_totalamount' => 'required|numeric|gt:0',
        ]);

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
            $data->cheque_no = $form_data['view_cheque_no'];
            $data->account_name = $form_data['view_account_name'];
            $payment_logs->bank_name = $form_data['view_bank_name'];
            $data->branch_location = $form_data['view_branch_location'];
        }else{
            $data->payment_status = "Completed";
            $sales->payment_balance = $sales->payment_balance - $form_data['view_totalamount'];
        }
        $data->payment_description = $form_data['view_salePaymentMethod'];
        $data->payment_method = $form_data['view_paymentType'];
        $data->customer_rep = $form_data['view_customer_rep'];

        $data->payment_balance = $payment['payment_balance'] - $form_data['view_totalamount'];

        if($sales->payment_balance <= 0.00){
            $sales->sales_status = "Fully Paid";
        }else{
            $sales->sales_status = "With Outstanding Balance";
        }

        $sales->save();
        $data->save();
    }

    function refresh(){
        $salesorders = DB::table('salesorder')
        ->select('salesorder.id', 'salesorder.payment_mode', 'salesorder.sales_status' , 'salesorder.payment_balance', 'salesorder.transaction_date', 'man_customers.customer_lname', 'man_customers.customer_fname')
        ->join('man_customers','salesorder.customer_id','=','man_customers.id')
        ->get();

        return $salesorders;
    }

    function getCompo(Request $request){
        $products = $request->input('products');
        $qty = $request->input('qty');
        $components = array();
        $raw_materials_in_components = array();
        for ($i=0; $i < count($products); $i++) { 

            $product = ManufacturingProducts::where('product_code', $products[$i])->first();
            $material = json_decode($product->materials, true);
            $component = json_decode($product->components, true);

            for ($x = 0; $x < count($material); $x++) {
                $material_id = $material[$x]['material_id'];
                $material_qty = $material[$x]['material_qty'];
                $raw_material = ManufacturingMaterials::where('id', $material_id)->first();
                $raw_material_name = $raw_material->item_name;
                $raw_material_code = $raw_material->item_code;
                $raw_material_reorder_qty = $raw_material->reorder_qty;
                $raw_material_reorder_level = $raw_material->reorder_level;
                $raw_material_category_id = $raw_material->category_id;
                $raw_material_quantity = $raw_material->rm_quantity;
                $category = MaterialCategory::where('id', $raw_material_category_id)->first();
                $raw_material_category = $category->category_title;
                array_push($components, 
                [
                    $material_qty * $qty[$i], 
                    $raw_material_category,
                    $raw_material_name, 
                    $raw_material_quantity, 
                    "item_code" => $raw_material_code,
                    "reorder_qty" => $raw_material_reorder_qty,
                    "reorder_level" => $raw_material_reorder_level,
                    "product_code" => $product->product_code,
                ]);
            }

            for ($x = 0; $x < count($component); $x++) {
                $component_id = $component[$x]['component_id'];
                $component_qty = $component[$x]['component_qty'];
                $raw_material = Component::where('id', $component_id)->first();
                $raw_material_category = "Component";
                $raw_material_name = $raw_material->component_name;
                $raw_material_quantity = 0;
                $raw_materials_needed = $raw_material->item_code;
                array_push($components, [$component_qty * $qty[$i], $raw_material_category, $raw_material_name, $raw_material_quantity, $raw_materials_needed, "product_code" => $product->product_code]);
            }
            
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

    function getReorderLevelAndQty($raw_material){
        $data = array();
        $raw_material = ManufacturingMaterials::where('item_name', $raw_material)->first();
        $raw_material_reorder_qty = $raw_material->reorder_qty;
        $raw_material_reorder_level = $raw_material->reorder_level;
        array_push($data, $raw_material_reorder_qty, $raw_material_reorder_level);
        return response($data);
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

    function minusStocks(Request $request){
        $products = $request->input('products');
        $qty = $request->input('qty');

        for ($i=0; $i < count($products); $i++) { 
            try {
                $raw_material = ManufacturingMaterials::where('item_code', $products[$i])->first();
                $raw_mat_qty = $raw_material->rm_quantity;

                if($raw_material != null or $raw_material != ""){
                    if($qty[$i] >= $raw_mat_qty){
                        $raw_material->rm_quantity = 0;
                    }else{
                        $raw_material->rm_quantity = $raw_material->rm_quantity - $qty[$i];
                    }
                    $raw_material->save();
                }
            } catch (\Throwable $th) {
                //Should just end when subtracting from components;
            }
        }
        return "Sucess in MinusStocks";
    }
}