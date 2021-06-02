<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\JobSched;
use App\Models\SalesOrder;
use App\Models\WorkOrder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class JobSchedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobscheds = JobSched::with('work_order')->get();
        return view('modules.manufacturing.jobscheduling', [
            'jobscheds' => $jobscheds,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $work_orders = WorkOrder::get();
        $employees = Employee::get();
        return view('modules.manufacturing.jobschedulinginfo', [
            'work_orders' => $work_orders,
            'employees' => $employees,
            'form_route' => route('jobscheduling.store'),
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
        // return response()->json([
        //     'request' => $request->all(),
        //     'action' => "create",
        // ]);

        $rules = [
            'planned_start.*' => 'required|string',
            'planned_end.*' => 'required|string',
            'work_order_no' => 'required|string|exists:work_order,work_order_no',
            'job_start_date' => 'required|date',
            'job_start_time' => 'required|string',
            'employee_id' => 'required|string|exists:env_employees,employee_id',
            'operations' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules, [
            'work_order_no.required' => 'You did not select a work order.',
            'job_start_date.required' => 'You did not set a start date.',
        ]);

        // 422 is the error code for bad input
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $jobsched = new JobSched();
            $jobsched->operations = $request->operations;
            $jobsched->start_date = $request->job_start_date;
            $jobsched->start_time = $request->job_start_time;
            $jobsched->employee_id = $request->employee_id;
            $jobsched->work_order_no = $request->work_order_no;
            $jobsched->js_status = "Draft";
            $jobsched->jobs_sched_id = "JOB-SCH-";
            $jobsched->save();
            # Setting a new ID based on the ID given to the object upon saving to the DB
            $jobsched->jobs_sched_id = "JOB-SCH-" . Carbon::now()->format("Y-") . str_pad($jobsched->id, 5, "0", STR_PAD_LEFT);
            $jobsched->save();

            return response()->json([
                'jobsched' => $jobsched,
                'action' => 'create',
                'redirect' => route('jobscheduling.index'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
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
        $item_code = $jobscheduling->work_order->item->product_code ?? $jobscheduling->work_order->item->component_code;
        $ordered_quantity = $jobscheduling->work_order->sales_order->orderedProducts($item_code)->quantity_purchased;
        return view('modules.manufacturing.jobschedulinginfo', [
            'work_orders' => $work_orders,
            'employees' => $employees,
            'jobsched' => $jobscheduling,
            'form_route' => route('jobscheduling.update', ['jobscheduling' => $jobscheduling]),
            'operations' => $jobscheduling->operations,
            // Re-encoding operations to escape the special characters
            'operations_encoded' => json_encode($jobscheduling->operations),
            'item_name' => $item_name,
            'quantity_purchased' => $ordered_quantity,
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
            'work_order_no' => 'required|string|exists:work_order,work_order_no',
            'job_start_date' => 'required|date',
            'job_start_time' => 'required|string',
            'employee_id' => 'required|string|exists:env_employees,employee_id',
            'operations' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules, [
            'work_order_no.required' => 'You did not select a work order.',
            'job_start_date.required' => 'You did not set a start date.',
        ]);

        // 422 is the error code for bad input
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $jobscheduling->operations = $request->operations;
            $jobscheduling->employee_id = $request->employee_id;
            $jobscheduling->start_date = $request->job_start_date;
            $jobscheduling->start_time = $request->job_start_time;
            $jobscheduling->work_order_no = $request->work_order_no;
            $jobscheduling->save();
            return response()->json([
                'request' => $request->all(),
                'jobsched' => $jobscheduling,
                'action' => 'update',
                'redirect' => route('jobscheduling.index'),
            ]);
        } catch (Exception $e) {
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

    public function get_operations(WorkOrder $work_order)
    {
        $item = $work_order->item;
        $routing = $item->bom()->routing;
        $code = $item->product_code ?? $item->component_code;
        $name = $item->product_name ?? $item->component_name;
        $ordered_quantity = $work_order->sales_order->orderedProducts($code)->quantity_purchased;
        return response()->json([
            'item_code' => $code,
            'item_name' => $name,
            'operations' => $routing->operationsThrough,
            'routingOperations' => $routing->routingOperations,
            'ordered_quantity' => $ordered_quantity,
        ]);
    }

    public function startOperation(Request $request)
    {
        //Needs tracking_id
        //Assuming that the operations json has the ff columns. sequence name, real start, real end
        $job = JobSched::where('id', $request->input('id'));
        $operations = json_decode($job->operations, true);
        for ($i = 0; $i < count($operations); $i++) {
            if ($operations[$i]['sequence_name'] == $request->input('sequence_name')) {
                $currDate = Carbon\Carbon::now();
                $currDate = $currDate->toDateString();
                $operations[$i]['status'] = "In progress";
                $operations[$i]['real_start'] = $currDate;
            }
        }
        $job->operations = json_encode($operations);
        $job->save();
        return response()->json([
            'operations' => json_encode($operations), 'sequence_name' => $request->input('sequence_name'),
            'jobSchedId' => $job->id
        ]);
    }

    public function pauseOperation(Request $request)
    {
        //Needs tracking_id
        //Assuming that the operations json has the ff columns. sequence name, real start, real end
        $job = JobSched::where('id', $request->input('id'));
        $operations = json_decode($job->operations, true);
        for ($i = 0; $i < count($operations); $i++) {
            if ($operations[$i]['sequence_name'] == $request->input('sequence_name')) {
                $operations[$i]['status'] = "Paused";
            }
        }
        $job->operations = json_encode($operations);
        $job->save();
        return response()->json([
            'operations' => json_encode($operations), 'sequence_name' => $request->input('sequence_name'),
            'jobSchedId' => $job->id
        ]);
    }

    public function finishOperation(Request $request)
    {
        //Needs tracking_id
        //Assuming that the operations json has the ff columns. sequence name, real start, real end
        $job = JobSched::where('id', $request->input('id'));
        $operations = json_decode($job->operations, true);
        for ($i = 0; $i < count($operations); $i++) {
            if ($operations[$i]['sequence_name'] == $request->input('sequence_name')) {
                $currDate = Carbon\Carbon::now();
                $currDate = $currDate->toDateString();
                $operations[$i]['status'] = "Finished";
                $operations[$i]['real_end'] = $currDate;
            }
        }
        $job->operations = json_encode($operations);
        $job->save();
        return response()->json([
            'operations' => json_encode($operations), 'sequence_name' => $request->input('sequence_name'),
            'jobSchedId' => $job->id
        ]);
    }
}
