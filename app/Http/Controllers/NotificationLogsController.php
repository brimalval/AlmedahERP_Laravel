<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\NotificationLog;

class NotificationLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_notifications()
    {
        $notif = NotificationLog::whereNull('read_at')->get();
        return response()->json(['results' => $notif]);
    }


}
