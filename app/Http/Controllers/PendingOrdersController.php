<?php

namespace App\Http\Controllers;

use App\Models\MaterialsOrdered;
use Illuminate\Http\Request;

class PendingOrdersController extends Controller
{
    //
    public function index() {
        $mat_ordered = MaterialsOrdered::all();
        return view('modules.buying.pendingorders', ['mat_ordered' => $mat_ordered]);
    }

    public function view_progress($id) {
        $order = MaterialsOrdered::find($id);
        $list = $order->items_list();
        return ['items_list' => $list];
    }
}
