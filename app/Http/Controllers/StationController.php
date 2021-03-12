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
    function index() {
        $stations = Station::get();
        return view('modules.manufacturing.workstation', ['stations' => $stations]);
    }
    
}
