<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class TestController extends Controller
{
    function index() {
        dd(Carbon::now()->setTimezone('Asia/Manila')->format('Y-m-d\TH:m'));
        return view('test');
    }

    function print(Request $request) {
        $date = Carbon::parse($request->testdate);
        dd($date->format("Y-d-m"));
    }
}
