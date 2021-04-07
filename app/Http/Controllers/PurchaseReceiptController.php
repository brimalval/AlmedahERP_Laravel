<?php

namespace App\Http\Controllers;

use App\Models\MaterialPurchased;
use App\Models\PurchaseReceipt;
use Illuminate\Http\Request;
use Exception;
use DB;

class PurchaseReceiptController extends Controller
{
    //
    public function index() {
        //$purchase_receipts = PurchaseReceipt::all();
        return view('modules.buying.purchasereceipt');
    }

    public function openReceiptForm() {
        $orders = MaterialPurchased::where('mp_status', 'To Receive and Bill')->get();
        return view('modules.buying.newPurchaseReceipt', ['orders' => $orders]); 
    }

    public function getOrderedMaterials($id) {
        try {
            $ordered_mats = MaterialPurchased::find($id)->itemsPurchased();
            return ['ordered_mats' => $ordered_mats];
        } catch(Exception $e) {
            return $e;
        }
    }

    public function createReceipt(Request $request) {
        try {

        } catch (Exception $e) {
            
        }
    }
}
