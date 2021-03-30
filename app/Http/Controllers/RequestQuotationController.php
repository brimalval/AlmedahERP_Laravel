<?php

namespace App\Http\Controllers;

use App\Models\MaterialQuotation;
use Illuminate\Http\Request;


class RequestQuotationController extends Controller
{
    //
    function index() {
        $quotations = MaterialQuotation::all();
        return view('modules.buying.requestforquotation', ['quotations' => $quotations]);
    }
}
