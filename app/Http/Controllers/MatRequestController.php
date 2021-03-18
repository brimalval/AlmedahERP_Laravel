<?php

namespace App\Http\Controllers;

use App\Models\MaterialRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mat_requests = MaterialRequest::get();
        return view('modules.buying.materialrequest', ['mat_requests' => $mat_requests]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'item_code' => 'required|string|exists:env_raw_materials',
            // MAY NEED TO CHANGE TO STATION_ID INSTEAD OF JUST ID    -v-
            'station_id' => 'required|string|exists:stations,station_id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ]);
        }
        try {
            $matRequest = new MaterialRequest();
            $matRequest->item_code = request('item_code');
            $matRequest->quantity = request('quantity_requested');
            $matRequest->required_date = request('required_date');
            // REMEMBER TO CHANGE THIS
            $matRequest->reorder_id = 1;
            $matRequest->procurement_method = request('procurement_method');
            $matRequest->purpose = request('purpose');
            $matRequest->uom_id = request('uom_id');
            $matRequest->station_id = request('station_id');
            $nextId = MaterialRequest::orderby('created_at', 'desc')->first()->id + 1;
            $matRequest->request_id = "REQ" . $nextId;
            $matRequest->save();
            return response()->json([
                'status' => 'success',
                'information' => $request->all(),
                'request' => $matRequest,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MaterialRequest  $materialrequest
     * @return \Illuminate\Http\Response
     */
    public function show(MaterialRequest $materialrequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MaterialRequest  $materialrequest
     * @return \Illuminate\Http\Response
     */
    public function edit(MaterialRequest $materialrequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MaterialRequest  $materialrequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaterialRequest $materialrequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MaterialRequest  $materialrequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaterialRequest $materialrequest)
    {
        //
    }
}
