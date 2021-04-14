<?php

namespace App\Http\Controllers;

use App\Models\ManufacturingProducts;
use App\Models\WorkOrder;
use App\Models\Component;
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
        $purchase_ids = array_unique($work_orders->pluck('purchase_id')->toArray());
        $purchase_ids = array_values($purchase_ids);
        $items = array();
        for ($p = 0; $p < count($purchase_ids); $p++) {
            $material_purchased = MaterialPurchased::where('purchase_id', $purchase_ids[$p])->first();
            $items_list = json_decode($material_purchased->items_list_purchased, true);
            foreach($items_list as $i){
                array_push($items, $i[0]);
            }
        }
        
        return view('modules.manufacturing.workorder', ['work_orders' => $work_orders, 'items' => $items]);
    }

    function getRawMaterials($selected){
        $component = Component::where('component_name', $selected)->first();
        return response($component->item_code);
    }

    function startWorkOrder(){
        return response('gumagana');
    }
}
