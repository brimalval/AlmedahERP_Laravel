<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewStockMovesController extends Controller
{
    public function index()
    {
        return view('modules.stock.newstockmoves');
    }
}
