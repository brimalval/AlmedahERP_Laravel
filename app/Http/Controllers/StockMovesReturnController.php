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
        $stock_transfer = StockTransfer::get();
        $stock_moves = StockMoves::get();
        // $stock_moves = StockMoves::where('tracking_id', $stock_transfer->tracking_id)->first();
        return view('modules.stock.stockmovesreturn', ['stock_transfer' => $stock_transfer, 'stock_moves'=> $stock_moves]);
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

                $stockMoves = StockMoves::where('tracking_id', request('tracking_id'))->first();
                $stockMovesTransfer = StockTransfer::where('tracking_id', request('tracking_id'))->first();
                $stockMovesTransfer->update(['item_code' => request('stockTransferItemsUpdated')]);
                if(count(json_decode($stockMovesTransfer->item_code, true)) == 0){
                    $stockMoves->update(['stock_moves_type' => 'Return', 'status'=> 'Successfully Returned']);
                }else{
                    $stockMoves->update(['stock_moves_type' => 'Return', 'status'=> 'Pending (Return)']);
                }     
                return response(count(json_decode($stockMovesTransfer->item_code, true)));
        } catch (Exception $e) {
            return $e;
        }
    }

    public function view_items($id) {
        $stock_transfer = StockTransfer::find($id);
        return response($stock_transfer->item_code);
    }
}
