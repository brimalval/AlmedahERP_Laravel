<?php

namespace App\Http\Controllers;

use App\Models\JobModel;
use Illuminate\Http\Request;
use DB;
use Exception;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    //
    function index() {
        $tasks = JobModel::all();
        return view('modules.projects.task', ['tasks' => $tasks]);
    }
}
