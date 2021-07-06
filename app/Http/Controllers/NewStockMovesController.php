<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Employee;
use App\Models\MaterialPurchased;
use App\Models\MaterialQuotation;
use \App\Models\MaterialsOrdered;
use App\Models\PurchaseReceipt;
use App\Models\RequestedRawMat;
use App\Models\RequestQuotationSuppliers;
use App\Models\Station;
use App\Models\SuppliersQuotation;
use App\Models\ManufacturingMaterials;
use App\Models\StockMoves;
use App\Models\StockTransfer;
use App\Models\StockMovesReturn;
use DB;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class NewStockMovesController extends Controller
{
    public function index()
    {
        $employees = Employee::get();
        $stockmoves = DB::table('stock_moves')->pluck('mat_ordered_id');
        $stations = Station::get();
        $materials_ordered = MaterialsOrdered::get();
        $raw_materials = ManufacturingMaterials::get();
        $conditions = array('New', 'Good', 'Damaged');

        return view('modules.stock.newstockmoves', [
            'employees' => $employees,
            'materials_ordered' => $materials_ordered,
            'raw_materials' => $raw_materials,
            'stations' => $stations,
            'conditions' => $conditions,
        ]);

    }

    public function showItemCodeNew($matOrderedId, $trackingId){
        if($matOrderedId != 'null'){
            $matOrdered = MaterialsOrdered::where('mat_ordered_id', $matOrderedId)->first();
            $items_list_received = json_decode($matOrdered->items_list_received, true);
            $consumable_data = array();
            foreach ($items_list_received as $item) {
                $raw_material = ManufacturingMaterials::where('item_code', $item['item_code'])->first();
                array_push($consumable_data, $raw_material->consumable);
            }

            $p_receipt_id = $matOrdered->p_receipt_id;
            $purchaseReceipt = PurchaseReceipt::where('p_receipt_id', $p_receipt_id)->first();

            $purchase_id = $purchaseReceipt->purchase_id;
            $matPurchased = MaterialPurchased::where('purchase_id', $purchase_id)->first();

            $supp_quotation_id = $matPurchased->supp_quotation_id;
            $suppliersQuotation = SuppliersQuotation::where('supp_quotation_id', $supp_quotation_id)->first();

            $req_quotation_id = $suppliersQuotation->req_quotation_id;
            $requestQuotation = MaterialQuotation::where('req_quotation_id', $req_quotation_id)->first();

            $request_id = $requestQuotation->request_id;
            $requestedRawMat = RequestedRawMat::where('request_id', $request_id)->first();

            $station_id = $requestedRawMat->station_id;
            $station = Station::where('station_id', $station_id)->first();
        }

        $stations = Station::get();
        $stock_transfer = StockTransfer::where('tracking_id', $trackingId)->first();
        $item_code = $stock_transfer->item_code;
        $transfer_status = $stock_transfer->transfer_status;
        return response()->json(['item_code'=>$item_code, 'transfer_status'=>$transfer_status, 'stations'=>$stations, 'station_name'=>$station->station_name ?? null, 'consumable_data'=>$consumable_data ?? null]);
    }
    public function showItemsNew($matOrderedId){
        $matOrdered = MaterialsOrdered::where('mat_ordered_id', $matOrderedId)->first();
        $items_list_received = json_decode($matOrdered->items_list_received, true);
        $consumable_data = array();
        foreach ($items_list_received as $item) {
           $raw_material = ManufacturingMaterials::where('item_code', $item['item_code'])->first();
           array_push($consumable_data, $raw_material->consumable);
        }

        $p_receipt_id = $matOrdered->p_receipt_id;
        $purchaseReceipt = PurchaseReceipt::where('p_receipt_id', $p_receipt_id)->first();

        $purchase_id = $purchaseReceipt->purchase_id;
        $matPurchased = MaterialPurchased::where('purchase_id', $purchase_id)->first();

        $supp_quotation_id = $matPurchased->supp_quotation_id;
        $suppliersQuotation = SuppliersQuotation::where('supp_quotation_id', $supp_quotation_id)->first();

        $req_quotation_id = $suppliersQuotation->req_quotation_id;
        $requestQuotation = MaterialQuotation::where('req_quotation_id', $req_quotation_id)->first();

        $request_id = $requestQuotation->request_id;
        $requestedRawMat = RequestedRawMat::where('request_id', $request_id)->first();

        $station_id = $requestedRawMat->station_id;
        $station = Station::where('station_id', $station_id)->first();

        return response()->json(['mat_ordered'=>$matOrdered,'station_name'=>$station->station_name, 'consumable_data'=>$consumable_data]);
        // return response($req_quotation_id);
    }

    public function showItemsRet($trackingId){
        $stock_transfer = StockTransfer::where('tracking_id', $trackingId)->first();
        $items_to_be_transferred = $stock_transfer->item_code;
        $stock_return = StockMovesReturn::where('tracking_id', $trackingId)->first();
        $stock_moves = StockMoves::where('tracking_id', $trackingId)->first();
        $mat_ordered_id = $stock_moves->mat_ordered_id;
        $mat_ordered = MaterialsOrdered::where('mat_ordered_id', $mat_ordered_id)->first();
        $items_list_received = $mat_ordered->items_list_received;

        if($stock_return){
            $items_to_be_returned = $stock_return->item_code;
        }
        return response()->json(['transfer'=>$items_to_be_transferred,'return'=>$items_to_be_returned ?? null, 'return_date'=>$stock_return->return_date ?? null, 'items_list_received'=>$items_list_received]);
    }

    public function store(Request $request){
        $rules = [
            'employee_id' => 'required|string|exists:env_employees,employee_id',
            'stock_moves_type' => 'required|string',
            'move_date' => 'required|date',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ]);
        }

        try {
            // $form_data = $request->input();
            // $data = \App\Models\StockMoves::create($form_data);
            // $data = \App\Models\StockTransfer::create($form_data);
            $sm = StockMoves::where('mat_ordered_id', request('mat_ordered_id'));
            if($sm->exists() && $sm->first()->mat_ordered_id != null){
                return Response::json(['error' => 'Error msg'], 404);
            }else{
                $stockMoves = new StockMoves();
                $stockMoves->move_date = request('move_date');
                $stockMoves->employee_id = request('employee_id');
                $stockMoves->mat_ordered_id = request('mat_ordered_id');
                $stockMoves->stock_moves_type = request('stock_moves_type');
                $stockMoves->tracking_id = "STOCK";
                $stockMovesTypeInitial = strtoupper(substr($stockMoves->stock_moves_type, 0, 3)).'-';
                $stockMoves->status = "Pending (Transfer)";
                $stockMoves->save();
                $stockMoves->tracking_id = "STO-".$stockMovesTypeInitial.Carbon::now()->year."-".str_pad($stockMoves->id, 5, '0', STR_PAD_LEFT);
                $stockMoves->save();


                $stockMovesTransfer = new StockTransfer();
                $stockMovesTransfer->tracking_id = $stockMoves->tracking_id;
                $stockMovesTransfer->move_date = request('move_date');
                $stockMovesTransfer->item_code = request('item_code');
                $stockMovesTransfer->source_station = request('source_station') ?? null;
                $stockMovesTransfer->target_station = request('target_station');
                $stockMovesTransfer->transfer_status = "Pending (Transfer)";
                $stockMovesTransfer->save();

                return response($stockMovesTransfer);
            }
        } catch (Exception $e) {
            return $e;
        }

    }

    public function view_items($id) {
        $order = MaterialsOrdered::find($id);
        return response($order->items_list_received);
    }

    public function getStockTransfer($trackingId){
        $stock_transfer = StockTransfer::where('tracking_id', $trackingId)->first();
        $stock_moves = StockMoves::where('tracking_id', $trackingId)->first();
        return response()->json(['stock_moves'=>$stock_moves, 'stock_transfer'=>$stock_transfer]);
    }

    public function saveStockTransfer($trackingId, Request $request){
        $item_code = request('item_code');
        $employee_id = request('employee_id');
        $move_date = request('move_date');
        $stock_transfer = StockTransfer::where('tracking_id', $trackingId)->first();
        $stock_transfer->update(['transfer_status' => 'Pending (Transfer)', 'item_code'=>$item_code, 'employee_id'=>$employee_id, 'move_date'=>$move_date]);
        return response($stock_transfer);
    }

    public function confirmStockTransfer($trackingId, Request $request){
        $item_code = $request->get('item_code');
        $employee_id = request('employee_id');
        $move_date = request('move_date');
        $stock_transfer = StockTransfer::where('tracking_id', $trackingId)->first();
        $stock_transfer->update(['transfer_status' => 'Successfully Transferred', 'item_code'=>$item_code, 'employee_id'=>$employee_id, 'move_date'=>$move_date]);
        $stock_moves = StockMoves::where('tracking_id', $trackingId)->first();
        $stock_moves->update(['status'=>'Successfully Transferred']);
        return response($stock_moves);
    }

    public function getRawMaterialQuantity($itemCode){
        $raw_material = ManufacturingMaterials::where('item_code', $itemCode)->first();
        $rm_quantity = $raw_material->rm_quantity;
        return response($rm_quantity);
    }
}