<?php

namespace App\Http\Controllers;

use \App\Models\ManufacturingMaterials;
use App\Models\ManufacturingProducts;
use App\Models\MaterialCategory;
use Illuminate\Http\Request;
use DB;
use Exception;
use Illuminate\Support\Facades\Validator;

class MaterialsController extends Controller
{
    function index(){
        $raw_materials = ManufacturingMaterials::with('category')->get();
        $man_mats_categories = MaterialCategory::get();
        return view('modules.manufacturing.inventory', [
            'raw_materials' => $raw_materials,
            'categories' => $man_mats_categories
        ]);
    }

    function get($id)
    {
        $material_details = ManufacturingMaterials::with('category')->find($id);
        return $material_details;
    }

    public function store(Request $request)
    {
        $request->validate([
            'material_code' => 'required|string',
            'material_name' => 'required|string',
            'material_category' => 'required|string',
            'unit_price' => 'required|integer|numeric|min:0',
            'total_amount' => 'required|integer|numeric|min:1',
            'rm_status' => 'required',
            'material_image' => 'required',
            'material_image.*' => 'image' 
        ]);

        try {
            /* Insert Material Record to env_raw_materials table */
            if($request->hasfile('material_image')){
                $imagePath = array();
                foreach($request->file('material_image') as $file)
                {
                    $name = $file->store('uploads', 'public');
                    array_push($imagePath, $name);  
                }
            }
            $form_data = $request->input();
            // Checking if an item already exists
            // If it does, add to its quantity
            $data = ManufacturingMaterials::where('item_code', '=', request('material_code'))->first();
            if($data){
                $data->total_amount += request('total_amount');
                $data->category->quantity += request('total_amount');
                $data->category->save();
                $data->save();
                return response()->json([
                    'status' => 'success',
                    'id' => $data->id,
                    'image' => $imagePath,
                    'category_title' => $data->category->category_title,
                    'message' => 'Added stock to item '.$data->item_code.': '.$data->item_name,
                    'already_exists' => true,
                    'new_amount' => $data->total_amount,
                    'material' => $data,
                ]);
            }
            $data = new ManufacturingMaterials();
            $data->item_code = $form_data['material_code'];
            $data->item_name = $form_data['material_name'];
            $data->category_id  = $form_data['material_category'];
            // Commenting this out for now since unit_price no longer exists
            // $data->unit_price = $form_data['unit_price'];
            $data->total_amount = $form_data['total_amount'];
            $data->category->quantity += $form_data['total_amount'];
            $data->category->save();
            $data->rm_status = $form_data['rm_status'];
            $data->item_image = json_encode($imagePath);
            $data->save();
            return response()->json([
                'status' => 'success',
                'image' => $imagePath,
                'id' => $data->id,
                'category_title' => $data->category->category_title,
                'material' => $data,
            ]);
        } catch (Exception $e) {
            return $e;
            // return response()->json([
            //     'status' => 'failed'
            // ]);
        }

        //dd(request()->all());
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'material_code' => 'required|string',
            'material_name' => 'required|string',
            'material_category' => 'required|string',
            'unit_price' => 'required|integer|numeric|min:0',
            'total_amount' => 'required|integer|numeric|min:1',
            'rm_status' => 'required',
        ]);

        try {
            /* Update Product Record from env_raw_materials table */
            $data = ManufacturingMaterials::find($id);
            // if (request('material_image')) {
            //     $imagePath = request('material_image')->store('uploads', 'public');
            //     $data->item_image = $imagePath;
            // }
            $image_bool = false;
            if($request->hasfile('material_image')){
                $imagePath = array();
                foreach($request->file('material_image') as $file)
                {
                    $name = $file->store('uploads', 'public');
                    array_push($imagePath, $name);
                }

                $data->item_image = json_encode($imagePath);
                $image_bool = true;
            }

            $form_data = $request->input();
            $data->item_code = $form_data['material_code'];
            $data->item_name = $form_data['material_name'];
            $data->category->quantity -= $data->total_amount;
            $data->category->save();
            $data->category_id  = $form_data['material_category'];
            $data->unit_price = $form_data['unit_price'];
            $data->total_amount = $form_data['total_amount'];
            $data->category->quantity += $data->total_amount;
            $data->category->save();
            $data->rm_status = $form_data['rm_status'];
            $data->save();

            return response()->json([
                'status' => 'success',
                'image' => $image_bool ? $imagePath : json_decode($data->item_image),
                'id' => $data->id,
                'category_title' => $data->category->category_title,
                'material' => $data,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed ' . $e
            ]);
        }
    }

    public function delete($id)
    {
        try {
            /* Delete Product Record from env_raw_materials table */
            $data = ManufacturingMaterials::find($id);
            if(ManufacturingProducts::where('materials', 'LIKE', '%material_id\\\\":\\\\"'.$id.'\\\\"%')->count()>0){
                return response()->json([
                    'status' => 'error',
                    'message' => 'There are products that depend on this material!',
                ]);
            }
            $data->category->quantity -= $data->total_amount;
            $data->category->save();
            $data->delete();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed ' . $e
            ]);
        }
    }

    public function storeCategory(Request $request){
        try {
            /* Insert Category to env_raw_categories table */
            $form_data = $request->input();
            $data = new MaterialCategory();
            $data->category_title = $form_data['category_title'];
            $data->description = $form_data['category_description'];
            $data->quantity  = 0;
            $data->save();
            return response()->json([
                'status' => 'success',
                'id' => $data->id,
                'category_title' => $data->category_title
            ]);
        } catch (Exception $e) {
            return $e;
            // return response()->json([
            //     'status' => 'failed'
            // ]);
        }
    }
    // Function called when adding stock. Throws an error if the material doesn't exist
    public function addStock($id){
        try{
            $material = ManufacturingMaterials::findOrFail($id);
            $material->total_amount += request('add_stock_qty');
            $material->category->quantity += request('add_stock_qty');
            $material->category->save();
            $material->save();
            return response()->json([
                'status'=>'success',
                'id' => $id,
                'new_amount' => $material->total_amount,
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => 'failure',
                'message' => $e->getCode(),
            ]);
        }
    }

    // Function for search suggestion regarding raw materials.
    public function searchMaterial(Request $request) {
        try {
            $search = $request->search;
            if($search == '')
                $materials = ManufacturingMaterials::select('item_name', 'item_code')->orderby('created_at', 'desc')->limit(5)->get();
            else
                $materials = ManufacturingMaterials::where('item_name', 'like', '%'.$search.'%')->orderby('created_at', 'desc')->limit(5)->get();
            $material_data = array();
            foreach($materials as $material) {
                $material_data[] = array(
                    "item_name" => $material->item_name,
                    "item_code" => $material->item_code
                );
            }
            return response()->json($material_data);
        } catch(Exception $e) {
            return $e;
        }
    }
}
