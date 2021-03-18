<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;
    protected $fillable = [
        'component_code',
        'component_name',
        'component_image',
        'component_description',
        'item_code',
    ];

    public function raw_material(){
        return $this->hasOne(ManufacturingMaterials::class, 'item_code', 'item_code');
    }
}
