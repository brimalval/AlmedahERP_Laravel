<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment_logs extends Model
{
    use HasFactory;
    protected $table = "payment_logs";
    public $timestamps = False;

    protected $fillable = [
        'date_of_payment',
        'sales_id',
        'amount_paid',
        'customer_rep',
        'payment_method',

        'payment_description',
        'payment_status',
        'payment_balance',
    ];

    protected $casts = [
        'date_of_payment' => 'date',
    ];
}
