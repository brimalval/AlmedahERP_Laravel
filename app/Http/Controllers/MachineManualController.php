<?php

namespace App\Http\Controllers;

use App\Models\MachineManual;
use Illuminate\Http\Request;
use DB;
use Exception;
use Illuminate\Support\Facades\Validator;

class MachineManualController extends Controller
{
    //
    function index() {
        $mac_manuals = MachineManual::all();
        
    }
}
