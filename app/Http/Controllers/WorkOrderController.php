<?php

namespace App\Http\Controllers;

use App\Models\ManufacturingProducts;
use App\Models\WorkOrder;
use App\Models\Component;
use App\Models\ordered_products;
use App\Models\MaterialPurchased;
use App\Models\MaterialRequest;
use App\Models\MaterialsOrdered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Exception;

class WorkOrderController extends Controller
{
    //
    function index() {
        $work_orders = WorkOrder::get();
        $sales_ids = array_unique($work_orders->pluck('sales_id')->toArray());
        $sales_ids = array_values($sales_ids);
        $components = array();
        $items = array();
        $quantity = array(); 
        $planned_dates = array();
        $items_qty = array();
        for ($p = 0; $p < count($sales_ids); $p++) {
            $work_order = WorkOrder::where('sales_id', $sales_ids[$p])->first();
            $work_order_no = $work_order->work_order_no;
            $material_request = MaterialRequest::where('work_order_no', $work_order_no)->first();
            if($material_request){
                $planned_start = $material_request->request_date->toDateString();
                $planned_end = $material_request->required_date->toDateString();
                array_push($planned_dates, [$planned_start, $planned_end]);
            }
            if($work_order->mat_ordered_id){
                $mat_ordered_id = $work_order->mat_ordered_id;
                $material_ordered = MaterialsOrdered::where('mat_ordered_id', $mat_ordered_id)->first();
                $items_list_received = $material_ordered->items_list();
                if($items_list_received){
                    foreach($items_list_received as $item){
                        array_push($items_qty, $item['qty_received']);
                    }   
                }else{
                    $items_qty = [];
                }
                array_push($quantity, $items_qty);

            }
            $ordered_product = ordered_products::where('sales_id', $sales_ids[$p])->first();
            $product_code = $ordered_product->product_code;
            array_push($items, $product_code);
            $product = ManufacturingProducts::where('product_code', $product_code)->first();
            $prod_components = $product->components;
            $components_list = json_decode($prod_components, true);
            foreach($components_list as $i){
                $component = Component::where('id', $i['component_id'])->first();
                array_push($components, $component->component_code);
            }
        }
        return view('modules.manufacturing.workorder', ['work_orders' => $work_orders, 'components' => $components, 'items' => $items, 'quantity' => $quantity, 'planned_dates' => $planned_dates]);
    }

    function getRawMaterials($selected, $sales_id){
        $component = Component::where('component_code', $selected)->first();
        $ordered_product = ordered_products::where('sales_id', $sales_id)->first();
        $product_code = $ordered_product->product_code;
        $quantity_purchased = $ordered_product->quantity_purchased;
        $product = ManufacturingProducts::where('product_code', $product_code)->first();
        $components = $product->components;
        $items_list = json_decode($components, true);
        foreach($items_list as $i){
            if($i['component_id'] == $component->id){
                $component_qty = $i['component_qty'];
            }
            // $component = Component::where('id', $i['component_id'])->first();
            // array_push($items, $component->component_code);
        }
        // return response($component->item_code);
        return response()->json(['item_code' => $component->item_code, 'quantity_purchased' => $quantity_purchased, 
        'component_qty' => $component_qty]);
    }

    function startWorkOrder($work_order_no){
        $date_now = date_create()->format('Y-m-d H:i:s');
        $work_order = WorkOrder::where('work_order_no', $work_order_no)->update([
            'work_order_status' => 'Started',
            'real_start_date' => $date_now,
        ]);
        $work_order = WorkOrder::where('work_order_no', $work_order_no)->first();
        return response($work_order);
    }
}
