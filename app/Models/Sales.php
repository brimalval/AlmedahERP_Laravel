<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = "sales";

    protected $fillable = [
        'customer_id',
        'cost_price',
        'sales_currency',
        'sale_supply_method',
        'quantity',
        'stock_unit',
        'product_launch_date',
        'product_pulled_off_market',
        'date',
        'prototype',
        'unrenewed',
        'payment_mode',
        'initial_payment',
        'payment_balance',
        'payment_track',
        'payment_status',
        'sales_status',
        'version',
        'description',
        'product_code',
        'sales_unit'       
    ];

    protected $casts = [
        'product_launch_date' => 'date',
        'product_pulled_off_market' => 'date', 
        'date' => 'date', 
    ];

}
