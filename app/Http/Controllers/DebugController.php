<?php

namespace App\Http\Controllers;

use App\Models\MaterialRequest;
use App\Models\RequestedRawMat;
use Illuminate\Http\Request;

class DebugController extends Controller
{
    public function index(){
        dd(RequestedRawMat::where('request_id', '=', 'MAT-MR-2021-00003')->pluck());
        dd(MaterialRequest::find(3)->raw_mats);
        return view('debug');
    }
}
