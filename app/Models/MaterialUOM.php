<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialUOM extends Model
{
    use HasFactory;
    protected $table = "materials_uom";
    public $timestamps = false;
    protected $fillable = [
        'item_uom',
        'conversion_factor',
        'price'
    ];
}
