<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Exception;

class StationController extends Controller
{
    //
    function index()
    {
        $stations = Station::all();
        return view('modules.manufacturing.workstation', ['stations' => $stations]);
    }

    function store(Request $request)
    {
        try {
            $form_data = $request->input();
            $data = new Station();
            $data->station_name = $form_data["station_name"];
            $data->description = $form_data["description"];

            // Generate ID for UOM
            // Based from schema documentation
            $lastStation = Station::orderby('created_at', 'desc')->first();
            $nextId = ($lastStation)
                        ? Station::orderby('created_at', 'desc')->first()->id + 1 
                        : 1;
            $data->station_id = "Station_" . $nextId;

            $data->save();
        } catch (Exception $e) {
        }
    }
}
