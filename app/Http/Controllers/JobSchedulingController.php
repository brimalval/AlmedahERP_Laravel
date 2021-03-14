<?php

namespace App\Http\Controllers;

use App\Models\JobSchedulingModel;
use Illuminate\Http\Request;
use DB;
use Exception;
use Illuminate\Support\Facades\Validator;

class JobSchedulingController extends Controller
{
    //
    function index() {
        $job_scheds = JobSchedulingModel::all();
        return view('modules.manufacturing.jobscheduling', ['job_scheds' => $job_scheds]);
    }
}
