<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockMovesReturnController extends Controller
{
    public function index()
    {
        return view('modules.stock.stockmovesreturn');
    }
}
