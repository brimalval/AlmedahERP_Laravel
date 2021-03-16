<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;

    protected $table = "salesOrder";
    public $timestamps = False;

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
        'payment_mode',
        'initial_payment',
        'payment_balance',
        'payment_track',
        'payment_status',
        'sales_status',
        'product_code',
        'sales_unit',
        'installment_type'
    ];

    protected $casts = [
        'product_launch_date' => 'date',
        'product_pulled_off_market' => 'date', 
        'date' => 'date', 
    ];

}
