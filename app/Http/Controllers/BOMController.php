<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManufacturingProducts;
use App\Models\BillOfMaterials;
use Exception;
use DB;

class BOMController extends Controller
{
    //
    public function index() {
        //$man_boms = BillOfMaterials::get();
        return view('modules.BOM.bom');
    }

    public function store(Request $request) {
        try {
            $form_data = $request->input();
            $data = new BillOfMaterials();
            //$data->product_code = $form_data["product_code"];
            //$data->bom_quantity = $form_data["quantity"];
            //$data->unit = $form_data["item_uom"];
            //$data->currency = $form_data["currency"];
            //$data->is_active = $form_data["is_active"];
            //$data->is_default = $form_data["is_default"];
            //$data->allow_alternative_item = $form_data["alt_item"];
            //$data->set_rate_assembly_item = $form_data["sub_item"];
            //$data->total_cost = $form_data["total_cost"];

            //$data->rates = json_encode($form_data["rates"]);

            $data->save();
        } catch (Exception $e) {
            return $e;
        }
    }
    
    public function get($bom_id) {
        try {
            //$bom = BillOfMaterials::find($bom_id);
            //$prev_bom = BillOfMaterials::where('id', '<', $bom_id)->limit(1)->get();
            //$next_bom = BillOfMaterials::where('id', '>', $bom_id)->limit(1)->get();
            //$product_data = ManufacturingProducts::where('product_code', $bom->product_code)->first();
            ////echo "<script>console.log('". $rates[0]."');</script>";
            //return view('modules.manufacturing.bominfo.bominfo', 
            //['bom' => $bom, 'prev_bom' => $prev_bom, 'next_bom' => $next_bom,'product_data' => $product_data]);
        } catch (Exception $e) {

        }
    }

    public function getMaterials($bom_id) {
        try {
            //$bom = BillOfMaterials::find($bom_id);
            //$product_data = ManufacturingProducts::where('product_code', $bom->product_code)->first();
            //$product_materials = $product_data->materials();
            //return response()->json([
            //    'product_mats' => $product_materials
            //]);
        } catch (Exception $e) {

        }
    }

    public function delete($bom_id) {
        try {
            $bom = BillOfMaterials::find($bom_id);
            $bom->delete();
        } catch (Exception $e) {

        }
    }

    public function updateStatus($bom_id) {
        try {
            $bom = BillOfMaterials::find($bom_id);
            $status = '';
            switch($bom->bom_status) {
                case 'Draft':
                    $status = 'Default';
                    break;
                case 'Default':
                case 'Active':
                    $status = 'Cancelled';
                    break;
            }
            $bom->bom_status = $status;
            $bom->save();
        } catch (Exception $e) {

        }
    }

    public function search(Request $request) {
        try{
            //$search = $request->search;
            //if($search == '') {
            //    $products = ManufacturingProducts::limit(5)->get();
            //} else {
            //    $products = ManufacturingProducts::where('product_code', 'like', '%'.$search.'%')->limit(5)->get();
            //}
            //$response = array();
            //foreach($products as $product) {
            //    $response[] = array("product_code" => $product->product_code, "product_name" => $product->product_name, "desc" => $product->internal_description);
            //}
            //return response()->json($response);
            
            //if($products->isEmpty()) {
            //
            //} else {
            //    foreach($products as $product) {
            //        $new_row['product_code'] = $product->product_code;
            //        $new_row['product_name'] = $product->product_name;
            //        $new_row['description'] = $product->internal_description;
            //
            //        $row_set[] = $new_row;
            //    }
            //
            //    json_encode($row_set);
            //}
        } catch (Exception $e) {

        }
    } 


}
