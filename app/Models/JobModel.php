<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobModel extends Model
{
    use HasFactory;
    protected $table = 'jobs';
    public $timestamps = true;
    protected $fillable = [
        'label_name',
        'task_name',
        'task_description',
        'resource',
        'process_time',
        'job_quantity',
        'process_type',
        'jobs_status'
    ];
}
