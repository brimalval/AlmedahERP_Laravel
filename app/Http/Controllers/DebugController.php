<?php

namespace App\Http\Controllers;

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
        dd(json_encode(MaterialRequest::first()->raw_mats));
        return view('debug');
    }
}
