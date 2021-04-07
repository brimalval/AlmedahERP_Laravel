<?php

namespace App\Http\Controllers;

use App\Models\MaterialPurchased;
use App\Models\PurchaseInvoice;
use App\Models\PurchaseReceipt;
use Illuminate\Http\Request;
use DB;
use Exception;

class PurchaseInvoiceController extends Controller
{
    //
    public function index() {
        //$purchase_invoice = PurchaseInvoice::all();
        return view('modules.buying.purchaseinvoice');
    }

    public function openInvoiceForm() {
        $receipts = PurchaseReceipt::where('pr_status', 'To Bill')->get();
        return view('modules.buying.newPurchaseInvoice', ['receipts' => $receipts]);
    }
}
