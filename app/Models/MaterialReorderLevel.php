<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialReorderLevel extends Model
{
    use HasFactory;
    protected $table = 'env_reorder_level';
    protected $fillable = [
        'reorder_id',
        'item_code',
        'reorder_qty',
    ];
    public $timestamps = false;
    
    public function item(){
        return $this->belongsTo(ManufacturingMaterials::class, 'item_code', 'item_code');
    }
}
