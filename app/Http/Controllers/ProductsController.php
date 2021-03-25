<?php

namespace App\Http\Controllers;

use App\Models\ItemGroup;
use App\Models\ManufacturingMaterials;
use App\Models\UnitOfMeasurement;
use \App\Models\ManufacturingProducts;
use \App\Models\ProductAttribute;
use \App\Models\ProductVariantWithValue;
use Illuminate\Http\Request;
use DB;
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
        $product_units = UnitOfMeasurement::all();
        $product_variants = ProductAttribute::all();
        return view('modules.manufacturing.item', [
            "man_products"=>$man_products,
            "item_groups"=>$item_groups,
            "raw_mats"=>$raw_mats,
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
            'materials' => 'required', 
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
            $data->picture = json_encode($imagePath);
            $data->product_category = (isset($form_data['product_category'])) ? $form_data['product_category'] : null;
            $data->product_name = $form_data['product_name'];
            $data->product_status = $form_data['product_status'];
            $data->product_type = $form_data['product_type'];
            $data->sales_price_wt = $form_data['sales_price_wt'];
            $data->unit = $form_data['unit'];

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
            $data = ProductVariantWithValue::find($id);
            $data->delete();
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
}
