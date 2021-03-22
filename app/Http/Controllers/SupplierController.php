<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupplierController extends Controller
{
    //
    function index() {
        return view('modules.buying.supplier');
    }   
}
