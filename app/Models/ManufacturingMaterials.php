<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturingMaterials extends Model
{
    use HasFactory;
    protected $table = 'env_raw_materials';
    public $timestamps = true;
    protected $fillable = [
        'item_code',
        'item_name',
        'item_image',
        'category_id',
        'unit_price',
        'total_amount',
        'total_amount_min',
        'rm_status'
    ];

    public function category(){
        return $this->belongsTo(MaterialCategory::class, 'category_id');
    }

    public function reorder_level(){
        return $this->hasOne(MaterialReorderLevel::class, 'item_code', 'item_code');
    }
}
