<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
use App\Models\ItemGroup;
use App\Models\ManufacturingMaterials;
use App\Models\UnitOfMeasurement;
use App\Models\Component;
use \App\Models\ManufacturingProducts;
use \App\Models\ProductAttribute;
use \App\Models\ProductVariantWithValue;
use App\Models\MaterialCategory;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use DB;
use \stdClass;
use PhpOption\None;
use Exception;
use Throwable;

class ProductsController extends Controller
{
    function index()
    {
        $man_products = ManufacturingProducts::get();
        $item_groups = ItemGroup::all();
        $raw_mats = ManufacturingMaterials::where('rm_status', 'Available')->get();
        $components = Component::all();
        $product_units = UnitOfMeasurement::all();
        $product_variants = ProductAttribute::all();
        return view('modules.manufacturing.item', [
            "man_products"=>$man_products,
            "item_groups"=>$item_groups,
            "raw_mats"=>$raw_mats,
            "components"=>$components,
            "product_units"=>$product_units,
            "product_variants"=>$product_variants,
        ]);
    }

    public function store(Request $request)
    {
        // Separated the rules from the validator to dynamically add rules
        // in case the thing we're adding is a variant
        // If it's a variant, it inherits its template's image by default
        $rules = [
            'product_name' => 'required|string',
            // 'product_category' => 'required', **remove comment if added in interface 
            'product_type' => 'required|string',
            'sales_price_wt' => 'required|integer|numeric|min:1',
            'unit' => 'required|alpha',
            'internal_description' => 'required|max:255',
            'bar_code' => 'required|alpha_num' ,
            'stock_unit' => 'required|integer|numeric|min:0',
            // Required to have at least 1 material OR at least 1 component 
            'materials' => 'required_if:components, {}', 
            'components' => 'required_if:materials, {}',
            'saleSupplyMethod' =>'required|string',
            'reorderLevel'=>'nullable|numeric|min:1',
            'reorderQty'=>'nullable|numeric|min:1',
            'prototype'=>'nullable|numeric|min:0',
            'manufacturing_date'=>'required|date',
            'product_pulled_off_market'=>'required|date'
        ];
        if(request('product_status') != 'Variant'){
            $rules['picture'] = 'required';
            $rules['picture.*'] = 'image';
        }
        $validation = $request->validate($rules);

        if(!$validation){
            return response()->json([
                'status' => 'error',
            ]);
        }
        try {

            // $form_data = $request->input();
            // \App\Models\ManufacturingProducts::create($form_data);

            /* Insert Product Record to man_products table */

            // Either there was an image submitted, or a variant is being made.
            // Inherit the picture from the template if the variant is not given
            // a picture
            
            if($request->hasfile('picture')){
                $imagePath = array();
                foreach($request->file('picture') as $file)
                {
                    $name = $file->store('uploads', 'public');
                    array_push($imagePath, $name);  
                }
            }else{
                $imagePath = request('template_img');
            }

            $form_data = $request->input();
            $data = new ManufacturingProducts();

            $data->bar_code = $form_data['bar_code'];
            $data->internal_description = $form_data['internal_description'];
            $data->materials = $form_data['materials'];
            $data->components = $form_data['components'];
            $data->picture = json_encode($imagePath);
            $data->product_category = (isset($form_data['product_category'])) ? $form_data['product_category'] : null;
            $data->product_name = $form_data['product_name'];
            $data->product_status = $form_data['product_status'];
            $data->product_type = $form_data['product_type'];
            $data->sales_price_wt = $form_data['sales_price_wt'];
            $data->unit = $form_data['unit'];
            $data->stock_unit = $form_data['stock_unit'];
            $data->sale_supply_method = $form_data['saleSupplyMethod'];
            $data->manufacturing_date = $form_data['manufacturing_date'];
            $data->product_pulled_off_market = $form_data['product_pulled_off_market'];
            
            //Would fail if prototype is unchecked
            //Since forms does not submit unchecked checkboxes
            try {
                $data->prototype = $form_data['prototype'];
            } catch (\Throwable $th) {
                $data->prototype = 0;
            }

            //If sales supply method stock is chosen adds reorderlevel and reorder qty
            if($form_data['saleSupplyMethod'] == "Made to Stock"){
                $data->reorder_level = $form_data['reorderLevel'];
                $data->reorder_qty = $form_data['reorderQty'];
            }

            if ($form_data['product_status'] == "Template") {
                $concat = substr($form_data['product_name'], 0, 3) . "-" . substr($form_data['product_type'], 0, 3);
                $code = strtoupper(str_replace(' ', '', $concat));
                $data->product_code = $code;
            } else {
                $code = $form_data['product_code'];
                if (isset($form_data['attribute_value_array'])) {
                    for ($i = 0; $i < count($form_data['attribute_value_array']); $i++) {
                        $code .= "-" . $form_data['attribute_value_array'][$i];
                    }
                }
                $data->product_code = strtoupper(str_replace(' ', '', $code));
            }

            $data->save();

            if (isset($form_data['attribute_array'])) {
                $i = 0;
                foreach ($form_data['attribute_array'] as $attribute) {
                    $variants = new ProductVariantWithValue();
                    $variants->product_id = $data->id;
                    $variants->attribute = $attribute;
                    $variants->value = $form_data['attribute_value_array'][$i] ?? '';
                    $variants->save();
                    $i++;
                }
            } 
            // if (isset($form_data['attribute_value_array'])) {
            //     foreach ($form_data['attribute_array'] as $attribute_value) {
            //         //$ProductVariantWithValueData = ProductVariantWithValue::where([['product_id', '=', $form_data['attribute_id']], ['attribute', '=', $form_data['attribute_name_array'][(int)$i]]])->first();
            //         // $ProductVariantWithValueData->value = $attribute_value;
            //         // $ProductVariantWithValueData->save();

            //         $variants = new ProductVariantWithValue();
            //         $variants->product_id = $data->id;
            //         $variants->attribute = $attribute;
            //         $variants->save();                    

            //     }
            // }


            return response()->json([
                'status' => 'success',
                'product' => $data,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->getCode(),
                'idk' => $e->getMessage(),
            ]);
        }

        //dd(request()->all());
    }

    public function update(Request $request, $id)
    {
        // $validation = $request->validate([
        //     'product_name' => 'required|alpha',
        //     // 'product_category' => 'required', **remove comment if added in interface 
        //     'product_type' => 'required|alpha_dash',
        //     'sales_price_wt' => 'required|integer|numeric',
        //     'unit' => 'required|alpha',
        //     'internal_description' => 'required|max:255',
        //     'bar_code' => 'required|alpha_num' 
        //     // 'materials' => 'required', **remove comment if added in interface 
        // ]);

        // if(!$validation){
        //     return response()->json([
        //         'status' => 'failed',
        //         'error' => $e
        //     ]);
        // }

        try {
            /* Update Product Record from man_products table */
            $data = ManufacturingProducts::find($id);
            $form_data = $request->input();

            if($request->hasfile('picture')){
                $imagePath = array();
                foreach($request->file('picture') as $file)
                {
                    $name = $file->store('uploads', 'public');
                    array_push($imagePath, $name);  
                }
                $data->picture = json_encode($imagePath);
            }

            $data->materials = $form_data['materials'];
            $data->product_code = $form_data['product_code'];
            $data->product_name = $form_data['product_name'];
            $data->product_status = $form_data['product_status'];
            $data->product_type = $form_data['product_type'];
            $data->sales_price_wt = $form_data['sales_price_wt'];
            $data->unit = $form_data['unit'];
            $data->internal_description = $form_data['internal_description'];
            $data->bar_code = $form_data['bar_code'];

            $data->sale_supply_method = $form_data['saleSupplyMethod'];
            $data->manufacturing_date = $form_data['manufacturing_date'];
            $data->product_pulled_off_market = $form_data['product_pulled_off_market'];
            
            //Would fail if prototype is unchecked
            //Since forms does not submit unchecked checkboxes
            try {
                $data->prototype = $form_data['prototype'];
            } catch (\Throwable $th) {
                $data->prototype = 0;
            }

            //If sales supply method stock is chosen adds reorderlevel and reorder qty
            if($form_data['saleSupplyMethod'] == "Made to Stock"){
                $data->reorder_level = $form_data['reorderLevel'];
                $data->reorder_qty = $form_data['reorderQty'];
            }

            $data->save();

            if (isset($form_data['attribute_array'])) {
                $i = 0;
                $curr_variants = ProductVariantWithValue::where('product_id', $id)->get();
                if($curr_variants)
                    foreach($curr_variants as $curr_variant)
                        $curr_variant->delete();
                foreach ($form_data['attribute_array'] as $attribute) {
                    $variants = new ProductVariantWithValue();
                    $variants->product_id = $data->id;
                    $variants->attribute = $attribute;
                    $variants->value = $form_data['attribute_value_array'][$i] ?? '';
                    $variants->save();
                    $i++;
                }
            } 
            
            return response()->json([
                'status' => 'success',
                'product' => $data,
                'update' => true,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getCode(),
            ]);
        }
    }

    public function delete($id)
    {
        try {
            /* Delete Product Record from man_products table */
            $data = ManufacturingProducts::find($id);
            $data->delete();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product does not exist!',
            ]);
        }
    }

    public function add_item_group(Request $request)
    {
        try {
            $form_data = $request->input();
            $data = new ItemGroup();
            $data->item_group = $form_data['item_group'];
            $data->save();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getCode(),
            ]);
        }
    }
    public function add_product_unit(Request $request)
    {
        try {
            $form_data = $request->input();
            $data = new UnitOfMeasurement();
            $data->unit = $form_data['unit_name'];
            $data->save();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getCode(),
            ]);
        }
    }
    public function add_attribute(Request $request)
    {
        try {
            $form_data = $request->input();
            $data = new ProductAttribute();
            $data->attribute = $form_data['attribute_name'];
            $data->save();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getCode(),
            ]);
        }
    }

    public function update_attribute(Request $request, $id)
    {
        try {
            $form_data = $request->input();
            $data = ProductVariantWithValue::find($id);
            $product_id = $data->product_id;
            $data->attribute = $form_data['edit-attribute-name'];
            $data->save();
            return response()->json([
                'status' => 'success',
                'product_id' => $product_id
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getCode(),
            ]);
        }
    }

    public function get_attribute($id)
    {
        try {
            /* Delete Product Record from man_products table */
            $data = ProductVariantWithValue::where('product_id', $id)->get();
            $product = ManufacturingProducts::find($id);
            return response()->json([
                'status' => $data,
                'type' => $product->product_status,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getCode(),
            ]);
        }
    }

    public function delete_attribute($id)
    {
        try {
            /* Delete Product Record from man_products table */
            // $data = ProductVariantWithValue::find($id);
            $data = ProductVariantWithValue::where('attribute', $id)->first();
            $data->delete();
            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getCode(),
            ]);
        }
    }

    public function getLowOnStocks(){
        $data = DB::select( DB::raw("select * from `man_products` where (stock_unit < reorder_level and sale_supply_method = 'Made to Stock')"));
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function getComponent(Request $request){
        $product_id = $request->input('id');
        $product = ManufacturingProducts::where('id', $product_id)->first();

        $material = json_decode($product->materials, true);
        $component = json_decode($product->components, true);

        $components = array();
        $raw_materials_in_components = array();
        
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
                $material_qty, 
                $raw_material_category,
                $raw_material_name, 
                $raw_material_quantity, 
                "item_code" => $raw_material_code,
                "reorder_qty" => $raw_material_reorder_qty,
                "reorder_level" => $raw_material_reorder_level
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
            array_push($components, [$component_qty, $raw_material_category, $raw_material_name, $raw_material_quantity, $raw_materials_needed]);
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


        return response()->json([
            'status' => 'success',
            'data' => $finalComponent
        ]);
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

    public function reorder(Request $request){
        $product_id = $request->input('id');
        $product = ManufacturingProducts::where('id', $product_id)->first();
        $quantity_to_reproduce = $request->input('quan');
        $raw_materials = json_decode($product->materials, true);
        $components = json_decode($product->components, true);

        $raw_materials_needed = array();
        $productMaterialsArray = array();
        $componentMaterialsArray = array();
        $productMaterials = array();
        $componentMaterials = array();
        foreach ($raw_materials as $raw_mat) {
            $material = ManufacturingMaterials::where('id', $raw_mat['material_id'])->first();
            $obj = new stdClass();
            $obj->mat = $material->item_code;
            $obj->needed = $raw_mat['material_qty']*$quantity_to_reproduce;
            $obj->stock = $material->rm_quantity;
            $obj->reorder_level = $material->reorder_level;
            $obj->uom = $material->uom_id;
            $obj->type = 'Product';
            array_push($raw_materials_needed, $obj);

            $obj = new stdClass();
            $obj->item_code = $material->item_code;
            if($material->rm_quantity >= $raw_mat['material_qty']*$quantity_to_reproduce){
                $passvalue = $raw_mat['material_qty']*$quantity_to_reproduce; 
            }else{
                $passvalue = $material->rm_quantity;
            }
            $obj->transferred_qty = $passvalue;
            $obj->status = 'pending';
            array_push($productMaterialsArray, $obj);
        }

        foreach ($components as $comp) {
            $component = Component::where('id', $comp['component_id'])->first();
            $items = json_decode($component->item_code, true);
            $component_qty = $comp['component_qty'];
            $preComponentMaterialsArray = array();
            foreach($items as $item){
                $item_exists = false;
                $material = ManufacturingMaterials::where('item_code', $item['item_code'])->first();
                foreach($raw_materials_needed as $raw_needed){
                    if($item['item_code'] == $raw_needed->mat){
                        $item_exists = true;
                        $add = $raw_needed->needed + $item['item_qty']*$quantity_to_reproduce*$component_qty;
                        $raw_needed->needed = $add;
                        break;
                    }
                }
                if(!$item_exists){
                    $obj = new stdClass();
                    $obj->mat = $item['item_code'];
                    $obj->needed = $item['item_qty']*$quantity_to_reproduce*$component_qty;
                    $obj->stock = $material->rm_quantity;
                    $obj->reorder_level = $material->reorder_level;
                    $obj->uom = $material->uom_id;
                    $obj->type = 'Component';
                    array_push($raw_materials_needed, $obj);
                }

                $obj = new stdClass();
                $obj->item_code = $material->item_code;
                if($material->rm_quantity >= $raw_mat['material_qty']*$quantity_to_reproduce){
                    $passvalue = $raw_mat['material_qty']*$quantity_to_reproduce; 
                }else{
                    $passvalue = $material->rm_quantity;
                }
                $obj->transferred_qty = $passvalue;
                $obj->status = 'pending';
                array_push($preComponentMaterialsArray, $obj);
            }
            array_push($componentMaterialsArray, $preComponentMaterialsArray);
        }

        $matRequests = array();
        foreach($raw_materials_needed as $raw_needed){
            if($raw_needed->needed >= $raw_needed->stock){
                $obj = new stdClass();
                $obj->item_code = $raw_needed->mat;
                $obj->quantity_needed_for_request = $raw_needed->needed;
                $obj->uom = $raw_needed->uom;
                array_push($matRequests, $obj);
            }
        }

        $productCode = $product->product_code;

        $productObj = new stdClass();
        $productObj->$productCode = $productMaterialsArray;
        
        //@TODO Material Request and work order
        $work_order_ids = array();

        $work_order = new WorkOrder();
        $work_order->product_code = $product->product_code;
        $work_order->mat_ordered_id = null;
        $work_order->sales_id = null;
        $work_order->planned_start_date = null;
        $work_order->planned_end_date = null;
        $work_order->real_start_date = null;
        $work_order->real_end_date = null;
        $work_order->work_order_status = "Pending";
        $work_order->work_order_no = "WOK";
        $work_order->transferred_qty = json_encode($productObj);
        $work_order->save();
        $won = "WOR-PR-".Carbon::now()->year."-".str_pad($work_order->id, 5, '0', STR_PAD_LEFT);
        $work_order->work_order_no = $won;
        $work_order->save();
        array_push($work_order_ids, $work_order->id);

        foreach($components as $i=>$comp){
            $component = Component::where('id', $comp['component_id'])->first();
            $component_code = $component->component_code;
            $component_name = $component->component_name;

            $work_order = new WorkOrder();
            $work_order->component_code = $component_code;
            $work_order->mat_ordered_id = null;
            $work_order->sales_id = null;
            $work_order->planned_start_date = null;
            $work_order->planned_end_date = null;
            $work_order->real_start_date = null;
            $work_order->real_end_date = null;
            $work_order->work_order_status = "Pending";
            $work_order->work_order_no = "WOK";

            $componentObj = new stdClass();
            $componentObj->$productCode = $componentMaterialsArray[$i];

            $work_order->transferred_qty = json_encode($componentObj);
            $work_order->save();
            $won = "WOR-CO-".Carbon::now()->year."-".str_pad($work_order->id, 5, '0', STR_PAD_LEFT);
            $work_order->work_order_no = $won;
            $work_order->save();
            array_push($work_order_ids, $work_order->id);
        }

        // return response($matRequests);
        return response()->json(['productMaterials'=>$productObj, 'componentMaterials'=>$componentObj,  'matRequests'=>$matRequests, 'work_order_ids'=>json_encode($work_order_ids)]);
    }
}