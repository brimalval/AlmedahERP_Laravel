<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierMats extends Model
{
    use HasFactory;

    protected $table = 'supplier_mats';
    protected $fillable = [
        'item_code',
        'supplier_id',
    ];

    public function raw_material(){
        return $this->belongsTo(ManufacturingMaterials::class, 'item_code', 'item_code');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }
}
