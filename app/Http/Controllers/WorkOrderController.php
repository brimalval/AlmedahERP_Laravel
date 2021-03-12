<?php

namespace App\Http\Controllers;

use App\Models\ManufacturingProducts;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Exception;

class WorkOrderController extends Controller
{
    //
    function index() {
        $work_orders = WorkOrder::get();
        return view('modules.manufacturing.workorder', ['work_orders' => $work_orders]);
    }
}
