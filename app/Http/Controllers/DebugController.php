<?php

namespace App\Http\Controllers;

use App\Models\ManufacturingProducts;
use App\Models\MaterialRequest;
use App\Models\RequestedRawMat;
use Illuminate\Http\Request;

class DebugController extends Controller
{
    public function index(){
        dd(MaterialRequest::find(3)->raw_mats);
        return view('debug');
    }
}
