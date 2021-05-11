<?php

namespace App\Http\Controllers;

use App\Models\MachinesManual;
use Illuminate\Http\Request;

class MachinesManualController extends Controller
{
    //
    public function index() 
    {
        $machines_manual = MachinesManual::all();
        return view('modules.BOM.machinemanual', ['machines_manuals' => $machines_manual]);
    }

    public function view($id) 
    {
        $machine_manual = MachinesManual::find($id);
        return view('modules.BOM.machineinfo', ['manual' => $machine_manual]);
    }

    public function store(Request $request) 
    {
        $machine_manual = new MachinesManual();
        $form_data = $request->input();
        /**code here */
        $machine_name = $form_data['machine_name'];
        $words = explode(' ', $machine_name);
        $machine_code = "";
        foreach ($words as $word) {
            $machine_code .= $word[0];
        }
        $machine_manual->machine_code = $machine_code;
        $machine_manual->machine_name = $machine_name;
        $machine_manual->machine_description = $form_data['machine_desc'];
        $machine_manual->machine_process = $form_data['machine_process'];
        $machine_manual->setup_time = $form_data['setup_time'];
        $machine_manual->running_time = $form_data['running_time'];
        $machine_manual->save();
    }

    public function update(Request $request, $id) 
    {
        $machine_manual = MachinesManual::find($id);
        $form_data = $request->input();
        /**code here*/
        $machine_manual->save();
    }

    public function delete($id)
    {
        $machine_manual = MachinesManual::find($id);
        $machine_manual->delete();
    }
}
