<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaterialUOM;
use DB;
use Exception;
use Illuminate\Support\Facades\Validator;

class MaterialUOMController extends Controller
{
    //
    public function index()
    {
        $uoms = MaterialUOM::all();
        return view('modules.stock.UOM', ['uoms' => $uoms]);
    }

    public function store(Request $request)
    {
        try {
            $form_data = $request->input();

            $data = new MaterialUOM();

            $data->item_uom = $form_data['name'];
            $data->conversion_factor = $form_data['conv'];
            $data->price = $form_data['price'];

            echo "<script>console.log(".$data.");</script>";

            $data->save();

            //$id = MaterialUOM::select('id')->where('item_uom', $form_data['name'])->first();
//
            //$data->uom_id = "UOM_" . $id;
//
            //$data->save();
//
            //dd($data);
        } catch (Exception $e) {
        }
    }
}
