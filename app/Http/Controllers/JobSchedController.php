<?php

namespace App\Http\Controllers;

use App\Models\JobSched;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
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
    public function edit(JobSched $jobsched)
    {
        $work_orders = WorkOrder::get();
        return view('modules.manufacturing.jobschedulinginfo', [
            'work_orders' => $work_orders,
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
        //
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
        $routing = $work_order->item->bom()->routing;
        return response()->json([
            'operations' => $routing->operationsThrough,
            'routingOperations' => $routing->routingOperations,
        ]);
    }

    public function startOperation(Request $request){
        //Needs tracking_id
        //Assuming that the operations json has the ff columns. sequence name, real start, real end
        $job = JobSched::where('id', $request->input('id'));
        $operations = json_decode($job->operations, true);
        for ($i=0; $i < count($operations); $i++) { 
            if ($operations[$i]['sequence_name'] == $request->input('sequence_name')) {
                $currDate = Carbon\Carbon::now();
                $currDate = $currDate->toDateString();
                $operations[$i]['status'] = "In progress";
                $operations[$i]['real_start'] = $currDate;
            }
        }
        $job->operations = json_encode($operations);
        $job->save();
        return response()->json(['operations' => json_encode($operations), 'sequence_name' => $request->input('sequence_name'), 
            'jobSchedId' => $job->id]);
    }

    public function pauseOperation(Request $request){
        //Needs tracking_id
        //Assuming that the operations json has the ff columns. sequence name, real start, real end
        $job = JobSched::where('id', $request->input('id'));
        $operations = json_decode($job->operations, true);
        for ($i=0; $i < count($operations); $i++) { 
            if ($operations[$i]['sequence_name'] == $request->input('sequence_name')) {
                $operations[$i]['status'] = "Paused";
            }
        }
        $job->operations = json_encode($operations);
        $job->save();
        return response()->json(['operations' => json_encode($operations), 'sequence_name' => $request->input('sequence_name'), 
            'jobSchedId' => $job->id]);
    }

    public function finishOperation(Request $request){
        //Needs tracking_id
        //Assuming that the operations json has the ff columns. sequence name, real start, real end
        $job = JobSched::where('id', $request->input('id'));
        $operations = json_decode($job->operations, true);
        for ($i=0; $i < count($operations); $i++) { 
            if ($operations[$i]['sequence_name'] == $request->input('sequence_name')) {
                $currDate = Carbon\Carbon::now();
                $currDate = $currDate->toDateString();
                $operations[$i]['status'] = "Finished";
                $operations[$i]['real_end'] = $currDate;
            }
        }
        $job->operations = json_encode($operations);
        $job->save();
        return response()->json(['operations' => json_encode($operations), 'sequence_name' => $request->input('sequence_name'), 
            'jobSchedId' => $job->id]);
    }
}
