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

    // Return all the products associated with a sales order if a product code is not given
    // otherwise return only the ordered_product with the specified product code if it exists
    public function orderedProducts($product_code=null) {
        if (!isset($product_code)){
            return $this->hasMany(ordered_products::class, 'sales_id', 'id');
        }
        return ordered_products::where([['sales_id', $this->id], ['product_code', $product_code]])->first();
    }


}
