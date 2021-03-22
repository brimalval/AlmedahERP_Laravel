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
        'transaction_date',
        'payment_mode',

        'initial_payment',
        'installment_type',
        'sales_status',
        'sales'
    ];

    protected $casts = [
        'transaction_date' => 'date',
    ];

}
