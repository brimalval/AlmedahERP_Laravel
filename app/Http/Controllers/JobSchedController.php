<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\JobSched;
use App\Models\WorkOrder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobSchedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.manufacturing.jobscheduling', [
        ]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobSched  $jobscheduling
     * @return \Illuminate\Http\Response
     */
    public function show(JobSched $jobscheduling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobSched  $jobscheduling
     * @return \Illuminate\Http\Response
     */
    public function edit(JobSched $jobscheduling)
    {
        $work_orders = WorkOrder::get();
        $employees = Employee::get();
        $item_name = $jobscheduling->work_order->item->product_name ?? $jobscheduling->work_order->item->component_name;
        return view('modules.manufacturing.jobschedulinginfo', [
            'work_orders' => $work_orders,
            'employees' => $employees,
            'jobsched' => $jobscheduling,
            'form_route' => route('jobscheduling.update', ['jobscheduling' => $jobscheduling]),
            'operations' => $jobscheduling->operations,
            // Re-encoding operations to escape the special characters
            'operations_encoded' => json_encode($jobscheduling->operations),
            'item_name' => $item_name,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobSched  $jobscheduling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobSched $jobscheduling)
    {
        $rules = [
            'planned_start.*' => 'required|string',
            'planned_end.*' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);

        // 422 is the error code for bad input
        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        try{
            $jobscheduling->operations = $request->operations;
            $jobscheduling->employee_id = $request->employee_id;
            $jobscheduling->start_date = $request->job_start_date;
            $jobscheduling->start_time = $request->job_start_time;
            $jobscheduling->work_order_no = $request->work_order_no;
            $jobscheduling->save();
            return response()->json([
                'request' => $request->all(),
                'jobsched' => $jobscheduling,
            ]);
        } catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobSched  $jobscheduling
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobSched $jobscheduling)
    {
        //
    }

    public function get_operations(WorkOrder $work_order){
        // For now, this will only return up to the BOM of the item
        // Change it once the routing/operations models are updated
        $item = $work_order->item;
        $routing = $item->bom()->routing;
        $code = $item->product_code ?? $item->component_code;
        $name = $item->product_name ?? $item->component_name;
        return response()->json([
            'item_code' => $code,
            'item_name' => $name, 
            'operations' => $routing->operationsThrough,
            'routingOperations' => $routing->routingOperations,
        ]);
    }
}
