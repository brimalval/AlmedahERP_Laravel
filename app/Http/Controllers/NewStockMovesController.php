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

class NewStockMovesController extends Controller
{
    public function index()
    {
        $employees = Employee::get();
        $materials_ordered = MaterialsOrdered::get();
        //dd($employees);
        return view('modules.stock.newstockmoves', [
            'employees' => $employees,
            'materials_ordered' => $materials_ordered,
        ]);

    }
    public function showItems($matOrderedId){
        $matOrdered = MaterialsOrdered::where('mat_ordered_id', $matOrderedId)->first();
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

        return response()->json(['mat_ordered'=>$matOrdered,'station_name'=>$station->station_name]);
        // return response($req_quotation_id);
    }
}