<?php

namespace App\Http\Controllers;

use App\Models\ManufacturingProducts;
use App\Models\MaterialRequest;
use App\Models\RequestedRawMat;
use Illuminate\Http\Request;

class DebugController extends Controller
{
    public function index(){
        return view('debug');
    }
}
