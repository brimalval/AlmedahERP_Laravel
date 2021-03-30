<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ordered_products extends Model
{
    use HasFactory;
    protected $table = "ordered_products";
    public $timestamps = False;

    protected $fillable = [
        'sales_id',
        'product_code',
        'quantity_purchased',
    ];

    protected $casts = [
    ];

    public function salesOrder() {
        return $this->belongsTo(SalesOrder::class, 'id', 'sales_id');
    }
}
