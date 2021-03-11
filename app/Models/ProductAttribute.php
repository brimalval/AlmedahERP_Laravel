<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;
    protected $table = 'products_variant';
    protected $fillable = [
        'attribute'
    ];
    public $timestamps = true;
}
