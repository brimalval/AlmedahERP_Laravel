<?php

namespace App\Http\Controllers;

use App\Models\RoutingOperation;
use Exception;
use Illuminate\Http\Request;

class RoutingOperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
        try {
            $form_data = $request->input();
            $r_operation = new RoutingOperation();
            $r_operation->sequence_id = $form_data['seq_id'];
            $r_operation->operation_id = $form_data['operation'];
            $r_operation->routing_id = $form_data['routing_id'];
            $r_operation->hour_rate = $form_data['hour_rate'];
            $r_operation->operation_time = $form_data['operation_time'];
            $r_operation->operating_cost = floatval($form_data['hour_rate']) * floatval($form_data['operation_time']);
            $r_operation->save();
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
