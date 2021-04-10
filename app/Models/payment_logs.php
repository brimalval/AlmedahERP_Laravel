<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment_logs extends Model
{
    use HasFactory;
    protected $table = "payment_logs";
    public $timestamps = false;

    protected $fillable = [
        'date_of_payment',
        'sales_id',
        'amount_paid',
        'customer_rep',
        'payment_method',

        'payment_description',
        'payment_status',
        'payment_balance',
        'account_no',

        'cheque_no',
        'cheque_date'
    ];

    protected $casts = [
        'date_of_payment' => 'date',
        'cheque_date' =>'date',
    ];

    public function salesOrder() {
        return $this->belongsTo(SalesOrder::class, 'id', 'sales_id');
    }
}
