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
        'sale_supply_method',
        'transaction_date',
        'payment_mode',
        'payment_balance',
        'initial_payment',
        'installment_type',
        'sales_status',
    ];

    protected $casts = [
        'transaction_date' => 'date',
    ];

    public function paymentLogs() {
        return $this->hasMany(payment_logs::class, 'sales_id', 'id');
    }

    public function orderedProducts() {
        return $this->hasMany(ordered_products::class, 'sales_id', 'id');
    }
}
