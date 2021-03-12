<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMonitoring extends Model
{
    use HasFactory;
    
    protected $table = "product_monitoring";

    protected $fillable = [
        'customer_id',
        'station_id',
        'product_code',
        'planned_start_date',
        'planned_end_date',
        'real_start_date',
        'real_end_date',
        'pm_status',       
    ];

    protected $casts = [
        'planned_start_date' => 'date',
        'planned_end_date' => 'date', 
        'real_start_date' => 'date', 
        'real_end_date' => 'date',
    ];

    public function product(){
        return $this->hasOne(ManufacturingProducts::class, 'product_code', 'product_code');
    }
}
