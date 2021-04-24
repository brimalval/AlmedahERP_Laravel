<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;
    protected $table = 'work_order';
    public $timestamps = true;
    protected $fillable = [
        'sales_id',
        'mat_ordered_id',
        'work_order_status',
        'planned_start_date',
        'planned_end_date',
        'real_start_date',
        'real_end_date',
    ];
}
