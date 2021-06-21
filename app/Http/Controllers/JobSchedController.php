<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\JobSched;
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
        $finished_jobscheds = JobSched::with('work_order')->where('js_status', 'Finished')->get();
        return view('modules.manufacturing.jobscheduling', [
            'jobscheds' => $jobscheds,
            'finished_jobscheds' => $finished_jobscheds,
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
        try {
            if($jobscheduling->js_status != "Draft") {
                return response()->json([
                    "error" => "This JS entry is not a draft!",
                ], 400);
            }

            $jobscheduling->delete();
            return response()->json([
                "message" => "success",
            ]);
        } catch (Exception $e) {
            return response()->json([
                "error" => $e->getMessage(),
            ], 400);
        }
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

    public function startOperation(Request $request, JobSched $jobsched)
    {
        //Needs tracking_id
        //Assuming that the operations json has the ff columns. sequence name, real start, real end
        $job = $jobsched;
        $operations = json_decode($job->operations, true);
        $currDate = Carbon::now();
        // Format based on the format specified in the gantt chart JS
        // This may make it easier to parse the JSON
        $currDate = $currDate->format("Y-m-d H:i");
        $newDate = $currDate;
        for ($i = 0; $i < count($operations); $i++) {
            // if ($operations[$i]['sequence_name'] == $request->input('sequence_name')) {
            if ($operations[$i]['operation_id'] == $request->input('operation_id')) {
                if ($i > 0 && $operations[$i - 1]['real_end'] == "") {
                    return response()->json([
                        'errors' => array('predecessor' => 'This operation\'s predecessor is not yet finished!'),
                    ], 400);
                }

                if ($operations[$i]['real_end'] != "") {
                    return response()->json([
                        'errors' => array("pauseBtn" => "This operation has already finished."),
                    ], 400);
                }

                // If it was just paused, just make it unpause. If it does not have an existing start date
                // change the start date because that means it's the first time it's started. 
                // If both conditions fail, then the user is trying to start twice; throw an error
                if (isset($operations[$i]['is_paused']) && $operations[$i]['is_paused'] == true) {
                    $operations[$i]['is_paused'] = false;
                    $newDate = $operations[$i]['real_start'];
                } elseif ($operations[$i]['real_start'] == "") {
                    $operations[$i]['real_start'] = $currDate;
                } else {
                    return response()->json([
                        'errors' => array("startBtn" => "This operation has already started and was not paused.")
                    ], 400);
                }


                $operations[$i]['status'] = "In progress";
                break;
            }
        }
        $job->operations = json_encode($operations);
        $job->save();
        return response()->json([
            'operations' => json_encode($operations),
            'operation_id' => $request->input('operation_id'),
            'jobSchedId' => $job->id,
            'currDate' => $newDate,
        ]);
    }

    public function pauseOperation(Request $request, JobSched $jobsched)
    {
        //Needs tracking_id
        //Assuming that the operations json has the ff columns. sequence name, real start, real end
        $job = $jobsched;
        $operations = json_decode($job->operations, true);
        $currDate = Carbon::now();
        // Format based on the format specified in the gantt chart JS
        // This may make it easier to parse the JSON
        $currDate = $currDate->format("Y-m-d H:i");
        for ($i = 0; $i < count($operations); $i++) {
            // if ($operations[$i]['sequence_name'] == $request->input('sequence_name')) {
            if ($operations[$i]['operation_id'] == $request->input('operation_id')) {
                // If real start field is empty, then it has not started yet.
                // Throws an error back to the ajax request
                if ($operations[$i]['real_start'] == "") {
                    return response()->json([
                        'errors' => array("pauseBtn" => "This operation has not yet started."),
                    ], 400);
                }

                // If real end field is not empty, then it has already ended.
                // Throws an error
                if ($operations[$i]['real_end'] != "") {
                    return response()->json([
                        'errors' => array("pauseBtn" => "This operation has already finished."),
                    ], 400);
                }

                // Cannot pause again if already paused
                if (isset($operations[$i]['is_paused']) && $operations[$i]['is_paused']) {
                    return response()->json([
                        'errors' => array("pauseBtn" => "This operation is already paused."),
                    ], 400);
                }

                $operations[$i]['status'] = "Paused";
                $parsed_curr = Carbon::parse($currDate);
                $time_diff = 0;
                if (isset($operations[$i]['last_paused'])) {
                    $last_paused = $operations[$i]['last_paused'];
                    $parsed_last = Carbon::parse($last_paused);
                    // $time_diff = $parsed_last->diffInHours($parsed_curr);
                    $time_diff = $parsed_last->diffInMinutes($parsed_curr) / 60;
                } else {
                    $real_start = $operations[$i]['real_start'];
                    $parsed_start = Carbon::parse($real_start);
                    $time_diff = $parsed_start->diffInMinutes($parsed_curr) / 60;
                }
                $operations[$i]['total_hours'] = ($operations[$i]['total_hours'] ?? 0) + $time_diff;
                $operations[$i]['last_paused'] = $currDate;
                $operations[$i]['is_paused'] = true;
                break;
            }
        }
        $job->operations = json_encode($operations);
        $job->save();
        return response()->json([
            'operations' => json_encode($operations),
            'sequence_name' => $request->input('sequence_name'),
            'jobSchedId' => $job->id
        ]);
    }

    public function finishOperation(Request $request, JobSched $jobsched)
    {
        //Needs tracking_id
        //Assuming that the operations json has the ff columns. sequence name, real start, real end
        //Changing sequence name to operation_id
        $allFinished = false;
        $job = $jobsched;
        $operations = json_decode($job->operations, true);
        $currDate = Carbon::now();
        // Format based on the format specified in the gantt chart JS
        // This may make it easier to parse the JSON
        $currDate = $currDate->format("Y-m-d H:i");
        for ($i = 0; $i < count($operations); $i++) {
            // if ($operations[$i]['sequence_name'] == $request->input('sequence_name')) {
            if ($operations[$i]['operation_id'] == $request->input('operation_id')) {
                if ($operations[$i]['status'] == "Finished") {
                    return response()->json([
                        'errors' => array("finishBtn" => "This operation had already been finished."),
                    ], 400);
                }

                // If the operation hadn't even started yet, throw an error
                if ($operations[$i]['real_start'] == "") {
                    return response()->json([
                        'errors' => array("finishBtn" => "The operation has not started yet."),
                    ], 400);
                }

                // Total hours first gets recorded upon pausing
                // If the key does not exist, that means there was no pause in between start & finish
                if (!isset($operations[$i]['total_hours'])) {
                    $curr_parsed = Carbon::parse($currDate);
                    $start_parsed = Carbon::parse($operations[$i]['real_start']);
                    $operations[$i]['total_hours'] = $curr_parsed->diffInHours($start_parsed);
                }

                $operations[$i]['status'] = "Finished";
                $operations[$i]['real_end'] = $currDate;
                break;
            }
        }
        $job->operations = json_encode($operations);
        // If there is no next operation
        $final_op = $operations[sizeof($operations) - 1]['status'] ?? null;
        if (isset($final_op) && $final_op == "Finished") {
            $job->js_status = "Finished";
            $allFinished = true;
        }
        $job->save();
        return response()->json([
            'operations' => json_encode($operations),
            'sequence_name' => $request->input('sequence_name'),
            'jobsched' => $jobsched,
            'jobSchedId' => $job->id,
            'currDate' => $currDate,
            'status' => "Finished",
            'allFinished' => $allFinished,
        ]);
    }

    /**
     * Sets the status of a jobsched entry to the passed status arg
     *
     * @param JobSched $jobsched
     * @return json
     */
    public function set_status(JobSched $jobsched, $status)
    {
        try {
            if ($status == 'plan') {
                $jobsched->js_status = 'Planned';
            } elseif ($status == 'start') {
                $jobsched->js_status = 'In Progress';
            } elseif ($status == 'pause') {
                $jobsched->js_status = 'Paused';
            } else {
                return response()->json([
                    'error' => 'Unknown status.'
                ], 400);
            }
            $jobsched->save();
            return response()->json([
                'jobsched' => $jobsched,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function get_operations_gantt(JobSched $jobsched)
    {
        $operations = json_decode($jobsched->operations);
        $data = array();
        $links = array();
        array_push($data, array(
            'id' => $jobsched->jobs_sched_id,
            'text' => $jobsched->jobs_sched_id,
            'start_date' => $operations[0]->real_start,
            'duration' => 0,
            'parent' => 0,
            'progress' => 0,
            'open' => true,
            'status' => $jobsched->js_status,
        ));
        $i = 0;
        foreach ($operations as $operation) {
            $start_parsed = Carbon::parse($operation->real_start);
            $end_parsed = Carbon::parse($operation->real_end);
            $duration = $start_parsed->diffInDays($end_parsed);
            array_push($data, array(
                'id' => $jobsched->jobs_sched_id . "+" . $operation->operation_id,
                'text' => $operation->operation_id,
                'start_date' => $operation->real_start,
                'duration' => $duration,
                'parent' => $jobsched->jobs_sched_id,
                'open' => true,
                'status' => $operation->status,
            ));
            if ($i > 0) {
                array_push($links, array(
                    'id' => $jobsched->jobs_sched_id . "step" . ($i + 1) . "to" . ($i + 2),
                    'source' => $data[$i]['id'], // From Operation 1 
                    'target' => $data[$i + 1]['id'], // to Operation 2 
                    'type' => "0" // Specifies how should the arrows are displayed. 0 Means from end to start
                ));
            }
            $i++;
        }
        return response()->json(['data' => $data, 'links' => $links]);
    }
}
