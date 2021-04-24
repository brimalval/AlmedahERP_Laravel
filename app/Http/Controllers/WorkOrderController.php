<?php

namespace App\Http\Controllers;

use App\Models\ManufacturingProducts;
use App\Models\WorkOrder;
use App\Models\Component;
use App\Models\ordered_products;
use App\Models\MaterialPurchased;
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
        $items = array();

        for ($p = 0; $p < count($sales_ids); $p++) {
            $ordered_product = ordered_products::where('sales_id', $sales_ids[$p])->first();
            $product_code = $ordered_product->product_code;
            $product = ManufacturingProducts::where('product_code', $product_code)->first();
            $components = $product->components;
            $items_list = json_decode($components, true);
            foreach($items_list as $i){
                $component = Component::where('id', $i['component_id'])->first();
                array_push($items, $component->component_code);
            }
        }
        
        return view('modules.manufacturing.workorder', ['work_orders' => $work_orders, 'items' => $items]);
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

    function startWorkOrder(){
        return response('gumagana');
    }
}
