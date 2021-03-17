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
        'purchase_id',
        'materials_qty',
        'product_code',
        'sales_id',
        'work_order_status',
    ];
}
