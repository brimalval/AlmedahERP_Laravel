<?php

namespace App\Http\Controllers;

use App\Models\JobSched;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class JobSchedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workorders = WorkOrder::get();
        return view('modules.manufacturing.jobscheduling', [
            'workorders' => $workorders,
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
        return view('modules.manufacturing.jobschedulinginfo');
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
}
