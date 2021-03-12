<?php

namespace App\Http\Controllers;

use App\Models\MaterialRequest;
use Illuminate\Http\Request;
use DB;
use Exception;
use Illuminate\Support\Facades\Validator;

class MatRequestController extends Controller
{
    //
    function index() {
        $mat_requests = MaterialRequest::get();
        return view('modules.buying.materialrequest', ['mat_requests' => $mat_requests]);
    }
}
