<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkCenter extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'work_center';
    public $timestamps = true;
    protected $fillable = [
        'wc_code',
        'wc_label',
        'wc_type',
        'machine_code',
        'employee_id',
        'set-up_time',
        'duration'
    ];
}
