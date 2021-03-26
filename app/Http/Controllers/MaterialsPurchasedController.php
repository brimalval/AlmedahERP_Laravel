<?php

namespace App\Http\Controllers;

use App\Models\MaterialPurchased;
use App\Models\MaterialRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Exception;
use Illuminate\Support\Facades\Validator;


class MaterialsPurchasedController extends Controller
{
    //
    function index()
    {
        $materials_purchased = MaterialPurchased::all();
        return view('modules.buying.purchaseorder', ['materials_purchased' => $materials_purchased]);
    }

    function openOrderForm()
    {
        $material_requests = MaterialRequest::all();
        return view('modules.buying.newpurchaseorder', ['material_requests' => $material_requests]);
    }

    function store(Request $request)
    {
        $data = new MaterialPurchased();

        $form_data = $request->input();

        $lastPayment = MaterialPurchased::orderby('id', 'desc')->first();
        $to_add = ($lastPayment) ? 1 : 0;
        $nextId = MaterialPurchased::orderby('id', 'desc')->first()->id + $to_add;

        $to_append = 0;
        $digit_flag = 1;
        while ($nextId >= $digit_flag) {
            ++$to_append;
            $digit_flag *= 10;
        }

        $purchase_id = "PUR-ORD-" . Carbon::now()->year() . str_pad($nextId, 5-$to_append, '0', STR_PAD_LEFT);

        $data->purchase_id = $purchase_id;
        
    }
}
