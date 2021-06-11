<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockMovesReturn;
use App\Models\StockTransfer;
use App\Models\StockMoves;
class StockMovesReturnController extends Controller
{
    public function index()
    {
        return view('modules.stock.stockmovesreturn');
    }

    public function store(Request $request){
        try {
            // $form_data = $request->input();
            // $data = \App\Models\StockMoves::create($form_data);
            // $data = \App\Models\StockTransfer::create($form_data);
            if(StockMovesReturn::where('tracking_id', request('tracking_id'))->exists()){
                if(empty(json_decode(request('item_code'), true))){
                    return Response::json(['error' => 'Error msg'], 404);
                }
                StockMovesReturn::where('tracking_id', request('tracking_id'))->delete();
            }
                $stockMovesReturn = new StockMovesReturn();
                $stockMovesReturn->tracking_id = request('tracking_id');
                $stockMovesReturn->return_date = request('return_date');
                $stockMovesReturn->item_code = request('item_code');
                $stockMovesReturn->return_status = 'PENDING';
                $stockMovesReturn->save();

                $stockMoves = StockMoves::where('tracking_id', $stockMovesReturn->tracking_id)->first();
                $worked = '';
                $stockMovesTransfer = StockTransfer::where('tracking_id', $stockMovesReturn->tracking_id)->first();
                if(empty(json_decode(request('stockTransferItemsUpdated'), true))){
                    $stockMoves->update(['stock_moves_type' => 'Return']);
                    $worked = 'worked';
                }
                $stockMovesTransfer->update(['item_code' => request('stockTransferItemsUpdated')]);
                return response($worked);
        } catch (Exception $e) {
            return $e;
        }
    }
}
