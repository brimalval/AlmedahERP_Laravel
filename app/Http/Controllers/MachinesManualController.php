<?php

namespace App\Http\Controllers;

use App\Models\MachinesManual;
use Illuminate\Http\Request;

class MachinesManualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $machines_manual = MachinesManual::all();
        return view('modules.BOM.machinemanual', ['machines_manuals' => $machines_manual]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('modules.BOM.newmachinemanual');
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
        $machine_manual = new MachinesManual();
        $form_data = $request->input();
        /**code here */
        $machine_name = $form_data['Machine_name'];
        $words = explode(' ', $machine_name);
        $machine_code = "MM_";
        foreach ($words as $word) {
            $machine_code .= strtoupper($word[0]);
        }
        $machine_manual->machine_code = $machine_code;
        $machine_manual->machine_name = $machine_name;
        $machine_manual->machine_description = $form_data['Machine_Description'];
        $machine_manual->machine_process = $form_data['Machine_Process'];
        $machine_manual->setup_time = $form_data['Setup_time'];
        $machine_manual->running_time = $form_data['Running_time'];
        $machine_manual->save();
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
        $machine_manual = MachinesManual::find($id);
        return view('modules.BOM.machineinfo', ['manual' => $machine_manual]);
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
        $machine_manual = MachinesManual::find($id);
        $form_data = $request->input();
        $machine_name = $form_data['Machine_name'];
        $words = explode(' ', $machine_name);
        $machine_code = "MM_";
        foreach ($words as $word) {
            $machine_code .= strtoupper($word[0]);
        }
        $machine_manual->machine_code = $machine_code;
        $machine_manual->machine_name = $machine_name;
        $machine_manual->machine_description = $form_data['Machine_Description'];
        $machine_manual->machine_process = $form_data['Machine_Process'];
        $machine_manual->setup_time = $form_data['Setup_time'];
        $machine_manual->running_time = $form_data['Running_time'];
        $machine_manual->save();
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
        $machine_manual = MachinesManual::find($id);
        $machine_manual->delete();
    }

    public function getMachine($machine_code) 
    {
        $machine = MachinesManual::where('machine_code', $machine_code)->first();
        return ["machine" => $machine];
    }
}
