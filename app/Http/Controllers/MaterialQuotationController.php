<?php

namespace App\Http\Controllers;

use App\Mail\SupplierQuotationEmail;
use App\Models\ManufacturingMaterials;
use App\Models\MaterialQuotation;
use App\Models\MaterialRequest;
use App\Models\MaterialUOM;
use App\Models\RequestQuotationSuppliers;
use App\Models\Station;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MaterialQuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rfquotations = MaterialQuotation::with(['request_quotation', 'suppliers'])->get();
        return view('modules.buying.requestforquotation', [
            'rfquotations' => $rfquotations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materials = ManufacturingMaterials::with(['uom', 'category'])->get();
        $stations = Station::get();
        $units = MaterialUOM::get();
        $suppliers = Supplier::get();
        $material_requests = MaterialRequest::with('raw_mats')
            ->where('mr_status', '=', 'Submitted')
            ->get();
        return view('modules.buying.requestforquotationform', [
            'materials' => $materials,
            'stations' => $stations,
            'units' => $units,
            'suppliers' => $suppliers,
            'material_requests' => $material_requests,
            'action' => route('rfquotation.store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'item_code' => 'required|array',
            'item_code.*' => 'required|string|exists:env_raw_materials,item_code',
            // MAY NEED TO CHANGE TO STATION_ID INSTEAD OF JUST ID    -v-
            'station_id.*' => 'required|string|exists:stations,station_id',
            'quantity_requested.*' => 'required|integer|min:0',
            'procurement_method.*' => 'required|string',
            'supplier_id' => 'required|array',
            'supplier_id.*' => 'required|string|exists:suppliers,supplier_id',
            'request_id' => 'required|string|exists:env_material_requests,request_id'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        try {
            $rfquotation = new MaterialQuotation();
            $rfquotation->req_quotation_id = "PUR-RFQ-" . Carbon::now()->year . "-";
            $rfquotation->date_created = Carbon::now()->format("Y-m-d");
            $rfquotation->req_status = "Draft";
            $rfquotation->request_id = request('request_id');
            $rfquotation->supplier_message = request('supplier_message') ?? "";
            // Creating the array of items and turning it into a json string
            $items = array();
            $item_codes = request('item_code');
            $quantities = request('quantity_requested');
            $station_ids = request('station_id');
            $uom_id = request('uom_id');
            $pms = request('procurement_method');
            for ($i = 0, $len = sizeof(request('item_code')); $i < $len; $i++) {
                array_push($items, [
                    'item_code' => $item_codes[$i],
                    'quantity_requested' => $quantities[$i],
                    'station_id' => $station_ids[$i],
                    'uom_id' => $uom_id[$i],
                    'procurement_method' => $pms[$i],
                ]);
            }
            $rfquotation->item_list = json_encode($items);
            // Completing the ID with the next ID in the table
            $rfquotation->save();
            $rfquotation->req_quotation_id .= str_pad($rfquotation->id, 5, '0', STR_PAD_LEFT);
            $rfquotation->save();
            // Creating the links between the quotation and the suppliers
            $supplier_ids = request('supplier_id');
            foreach ($supplier_ids as $supplier_id) {
                $rfquotation_supplier = new RequestQuotationSuppliers();
                $rfquotation_supplier->req_quotation_id = $rfquotation->req_quotation_id;
                $rfquotation_supplier->supplier_id = $supplier_id;
                $rfquotation_supplier->save();
            }

            return response()->json([
                'status' => 'success',
                'rfquotation' => $rfquotation,
                'suppliers' => $rfquotation->suppliers,
                'redirect' => route('rfquotation.index'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
                'message' => $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'request' => $request->all(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MaterialQuotation  $rfquotation
     * @return \Illuminate\Http\Response
     */
    public function show($rfquotation)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MaterialQuotation  $rfquotation
     * @return \Illuminate\Http\Response
     */
    public function edit(MaterialQuotation $rfquotation)
    {
        $materials = ManufacturingMaterials::with(['uom', 'category'])->get();
        $stations = Station::get();
        $units = MaterialUOM::get();
        $suppliers = Supplier::get();
        $material_requests = MaterialRequest::with('raw_mats')
            ->where('mr_status', '=', 'Submitted')
            ->get();
        return view('modules.buying.requestforquotationform', [
            'rfquotation' => $rfquotation,
            'materials' => $materials,
            'stations' => $stations,
            'units' => $units,
            'suppliers' => $suppliers,
            'material_requests' => $material_requests,
            'action' => route('rfquotation.update', ['rfquotation' => $rfquotation->id]),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MaterialQuotation  $rfquotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaterialQuotation $rfquotation)
    {
        $rules = [
            'item_code' => 'required|array',
            'item_code.*' => 'required|string|exists:env_raw_materials,item_code',
            // MAY NEED TO CHANGE TO STATION_ID INSTEAD OF JUST ID    -v-
            'station_id.*' => 'required|string|exists:stations,station_id',
            'quantity_requested.*' => 'required|integer|min:0',
            'procurement_method.*' => 'required|string',
            'supplier_id' => 'required|array',
            'supplier_id.*' => 'required|string|exists:suppliers,supplier_id',
            'request_id' => 'required|string|exists:env_material_requests,request_id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        try {
            $rfquotation->request_id = request('request_id');
            $rfquotation->supplier_message = request('supplier_message') ?? "";
            // Creating the array of items and turning it into a json string
            $items = array();
            $item_codes = request('item_code');
            $quantities = request('quantity_requested');
            $station_ids = request('station_id');
            $uom_id = request('uom_id');
            $pms = request('procurement_method');
            for ($i = 0, $len = sizeof(request('item_code')); $i < $len; $i++) {
                array_push($items, [
                    'item_code' => $item_codes[$i],
                    'quantity_requested' => $quantities[$i],
                    'station_id' => $station_ids[$i],
                    'uom_id' => $uom_id[$i],
                    'procurement_method' => $pms[$i],
                ]);
            }
            $rfquotation->item_list = json_encode($items);
            $rfquotation->save();
            // Deleting the old supplier_id entries
            RequestQuotationSuppliers::where('req_quotation_id', '=', $rfquotation->req_quotation_id)->delete();
            // Creating the links between the quotation and the suppliers
            $supplier_ids = request('supplier_id');
            foreach ($supplier_ids as $supplier_id) {
                $rfquotation_supplier = new RequestQuotationSuppliers();
                $rfquotation_supplier->req_quotation_id = $rfquotation->req_quotation_id;
                $rfquotation_supplier->supplier_id = $supplier_id;
                $rfquotation_supplier->save();
            }

            return response()->json([
                'status' => 'success',
                'rfquotation' => $rfquotation,
                'suppliers' => $rfquotation->suppliers,
                'redirect' => route('rfquotation.index'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MaterialQuotation  $rfquotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaterialQuotation $rfquotation)
    {
        try {
            $rfquotation->supplier_links()->delete();
            $rfquotation->delete();
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Send emails to the designated suppliers.
     * 
     * @param \App\Models\MaterialQuotation $rfquotation
     * @return \Illuminate\Http\Response
     */
    public function email_suppliers(MaterialQuotation $rfquotation)
    {
        try {
            $suppliers = $rfquotation->suppliers;
            $request_id = $rfquotation->req_quotation_id;
            $message = $rfquotation->supplier_message;
            foreach ($suppliers as $supplier) {
                Mail::to($supplier->supplier_email)
                    ->send(new SupplierQuotationEmail($request_id, $supplier, $message));
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'emails' => $rfquotation->suppliers()->pluck('supplier_email'),
        ]);
    }

    /**
     * Submit the request for quotation.
     * 
     * @param \App\Models\MaterialQuotation $rfquotation
     * @return \Illuminate\Http\Response
     */
    public function submit(MaterialQuotation $rfquotation)
    {
        try {
            $rfquotation->req_status = "Submitted";
            $rfquotation->save();
            return response()->json([
                'status' => 'success',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
