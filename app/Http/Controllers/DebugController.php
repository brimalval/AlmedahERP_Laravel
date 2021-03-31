<?php

namespace App\Http\Controllers;

use App\Mail\SupplierQuotationEmail;
use App\Models\ManufacturingProducts;
use App\Models\MaterialQuotation;
use App\Models\MaterialRequest;
use App\Models\RequestedRawMat;
use App\Models\RequestQuotationSuppliers;
use App\Models\Supplier;
use App\Models\SuppliersQuotation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DebugController extends Controller
{
    public function index(){
        return response()->json([
            'status' => 'error',
            'message' => 'Request has already been submitted!'
        ], 403);
        dd(json_encode(MaterialRequest::first()));
        return view('debug');
    }

    public function show(Request $request){
        if($request->hasValidSignature())
            dd($request->all());
        else
           abort(401);
    }
}
