<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use App\Models\WorkCenter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $operations = DB::table('operations')
        ->select('operations.id','operations.operation_id','operations.operation_name','operations.description','work_center.wc_label')
        ->join('work_center','operations.wc_code','=','work_center.wc_code')
        ->get();

        return view('modules.BOM.operation', ['operations' => $operations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $work_centers = WorkCenter::all();
        return view('modules.BOM.newoperation', ['work_centers' => $work_centers]);
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
            $last_operation = Operation::latest()->first();
            $next_id = $last_operation ? $last_operation->id + 1 : 1;
            $operation_id = "OP-" . str_pad($next_id, 5, "0", STR_PAD_LEFT);
            $form_data = $request->input();
            $operation = new Operation();
            $operation->operation_id = $operation_id;
            $operation->operation_name = $form_data['Operation_Name'];
            $operation->wc_code = $form_data['Default_WorkCenter'];
            $operation->description = $form_data['Description'];
            $operation->save();
            return ['operations' => Operation::all()];
        } catch (Exception $e) {
            return $e;
        }
    }

    public function getOperation($operation_id)
    {
        $operation = Operation::where('operation_id', $operation_id)->first();
        $wc = $operation->work_center;
        return ['operation' => $operation, 'wc' => $wc];
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
        $operation = Operation::find($id);
        $work_centers = WorkCenter::all();
        return view('modules.BOM.editoperation', ['work_centers' => $work_centers, 'operation' => $operation]);
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
        try {
            $form_data = $request->input();
            $operation = Operation::find($id);
            $operation->operation_name = $form_data['Operation_Name'];
            $operation->wc_code = $form_data['Default_WorkCenter'];
            $operation->description = $form_data['Description'];
            $operation->save();
            return ['operations' => Operation::all()];
        } catch (Exception $e) {
            return $e;
        }
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
        try {
            $operation = Operation::find($id);
            $operation->delete();
            return ['operations' => Operation::all()];
        } catch (Exception $e) {
            return $e;
        }
    }
}
