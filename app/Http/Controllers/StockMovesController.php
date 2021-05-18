<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Customer;

class StockMovesController extends Controller
{
        public function index()
    {
        return view('modules.stock.stockmoves');
    }
}
