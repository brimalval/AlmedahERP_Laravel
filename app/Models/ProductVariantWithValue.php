<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantWithValue extends Model
{
    use HasFactory;
    protected $table = 'products_variant_with_value';
    protected $fillable = [
        'product_id',
        'attribute',
        'value'
    ];
    public $timestamps = true;
}
