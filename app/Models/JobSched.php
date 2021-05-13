<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSched extends Model
{
    use HasFactory;
    protected $table = 'jobs_scheduling';
    public $timestamps = true;
    protected $fillable = [
        'jobs_sched_id',
        'start_date',
        'start_time',
        'js_status',
        'employee_id',
        'work_order_no',
        'operations'
    ];
}
