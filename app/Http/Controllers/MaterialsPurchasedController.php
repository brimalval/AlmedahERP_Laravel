<?php

namespace App\Http\Controllers;

use App\Models\MaterialPurchased;
use Illuminate\Http\Request;
use DB;
use Exception;
use Illuminate\Support\Facades\Validator;


class MaterialsPurchasedController extends Controller
{
    //
    function index() {
        $materials_purchased = MaterialPurchased::all();
        return view('modules.buying.purchaseorder', ['materials_purchased' => $materials_purchased]);
    }

    function store() {}
}
