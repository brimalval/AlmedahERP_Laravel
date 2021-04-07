<?php

namespace App\Http\Controllers;

use App\Models\MaterialPurchased;
use App\Models\PurchaseReceipt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use DB;

class PurchaseReceiptController extends Controller
{
    //
    public function index() {
        $purchase_receipts = PurchaseReceipt::all();
        return view('modules.buying.purchasereceipt', ['receipts' => $purchase_receipts]);
    }

    public function openReceiptForm() {
        $orders = MaterialPurchased::where('mp_status', 'To Receive and Bill')->get();
        return view('modules.buying.newPurchaseReceipt', ['orders' => $orders]); 
    }

    public function getOrderedMaterials($id) {
        try {
            $ordered_mats = MaterialPurchased::find($id)->itemsPurchased();
            $purchase_id = MaterialPurchased::find($id)->purchase_id;
            return ['ordered_mats' => $ordered_mats, 'purchase_id' => $purchase_id];
        } catch(Exception $e) {
            return $e;
        }
    }

    public function createReceipt(Request $request) {
        try {
            $form_data = $request->input();

            $data = new PurchaseReceipt();
            
            $lastReceipt = PurchaseReceipt::orderby('id', 'desc')->first();
            $nextId = ($lastReceipt) ? PurchaseReceipt::orderby('id', 'desc')->first()->id + 1 : 1;
            //$nextId = MaterialPurchased::orderby('id', 'desc')->first()->id + $to_add;

            $to_append = 0;
            $digit_flag = 1;
            while ($nextId >= $digit_flag) {
                ++$to_append;
                $digit_flag *= 10;
            }

            $receipt_id = "PR-" . str_pad($nextId, 3 - $to_append, '0', STR_PAD_LEFT);

            $data->p_receipt_id = $receipt_id;
            $data->date_created = $form_data['date_created'];
            $data->purchase_id = $form_data['purchase_id'];
            $data->item_list_received = json_encode($form_data['items_received']);
            $data->grand_total = $form_data['grand_total'];

            $data->save();

        } catch (Exception $e) {
            return $e;
        }
    }
}
