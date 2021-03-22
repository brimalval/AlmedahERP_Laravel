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

            // Generate ID for UOM
            // Based from schema documentation
            $lastUOM = MaterialUOM::orderby('created_at', 'desc')->first();
            $nextId = ($lastUOM)
                        ? MaterialUOM::orderby('created_at', 'desc')->first()->id + 1 
                        : 1;
            $data->uom_id = "UOM_" . $nextId;

            //echo "<script>console.log(".$data.");</script>";

            $data->save();

            return ['id' => $data->uom_id,
                    'name' => $data->item_uom, 
                    'conversion_factor' => $data->conversion_factor,
                    'price' => $data->price];

        } catch (Exception $e) {
        }
    }
}
