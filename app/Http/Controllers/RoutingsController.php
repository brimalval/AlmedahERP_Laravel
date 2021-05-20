<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use App\Models\RoutingOperation;
use App\Models\Routings;
use App\Models\WorkCenter;
use Exception;
use Illuminate\Http\Request;

class RoutingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routings = Routings::all();
        return view('modules.BOM.routing', ['routings' => $routings]);
    }

    public function view($id)
    {
        $routing = Routings::find($id);
        $operations = Operation::all();
        $routing_operation = $routing->operations();
        $work_centers = WorkCenter::all();
        return view('modules.BOM.editrouting', ['route' => $routing, 'operations' => $operations,
                                                'routing_operations' => $routing_operation, 'work_centers' => $work_centers]);
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
            $routing = new Routings();
            $last_routing = Routings::latest()->first();
            $form_data = $request->input();
            $next_id = $last_routing ? $last_routing->id + 1 : 1;
            $routing_id = "RT" . str_pad($next_id, 5, '0', STR_PAD_LEFT);
            $routing->routing_id = $routing_id;
            $routing->routing_name = $form_data['Routing_Name'];
            $routing->save();
            $routing = Routings::where('routing_id', $routing_id)->first();
            return ['routing_id' => $routing->routing_id];
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Routings  $routings
     * @return \Illuminate\Http\Response
     */
    public function show(Routings $routings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Routings  $routings
     * @return \Illuminate\Http\Response
     */
    public function edit(Routings $routings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Routings  $routings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Routings $routings)
    {
        //
        try {
            $form_data = $request->input();
            $routing = Routings::find($routings->id);
            echo $routings->id;
            $routing->routing_name = $form_data['Routing_Name'];
            $routing->save();
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Routings  $routings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Routings $routings)
    {
        //
    }

    public function delete($id)
    {
        $routing = Routings::find($id);
        $routing->delete();
    }

    public function openRoutingForm()
    {
        $operations = Operation::all();
        $work_centers = WorkCenter::all();
        return view('modules.BOM.newrouting', ['operations' => $operations, 'work_centers' => $work_centers]);
    }
}
