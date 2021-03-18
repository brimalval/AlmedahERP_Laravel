<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSchedulingModel extends Model
{
    use HasFactory;
    protected $table = 'jobs_scheduling';
    public $timestamps = true;
    protected $fillable = [
        'wbs_code',
        'predecessor',
        'successor',
        'part_code',
        'component_code',
        'task_id',
        'machine_code',
        'setup_time',
        'running_time',
        'total_hours',
        'days',
        'hrs',
        'start_time',
        'end_time',
        'js_status',
        'employee_id',
        'mfg_order_no'
    ];
}
