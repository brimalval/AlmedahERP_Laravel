<?php

namespace App\Http\Controllers;

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
}
