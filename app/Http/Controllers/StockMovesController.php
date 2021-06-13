<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Customer;
use App\Models\StockMoves;
class StockMovesController extends Controller
{
    public function index(){
        $stockmoves = StockMoves::get();
        return view('modules.stock.stockmoves', [
            'stockmoves' => $stockmoves
        ]);
    }
}
