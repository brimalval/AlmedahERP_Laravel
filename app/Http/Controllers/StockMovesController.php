<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockMovesController extends Controller
{
        public function index()
    {
        return view('modules.stock.stockmoves');
    }
}
