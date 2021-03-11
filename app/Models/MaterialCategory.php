<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialCategory extends Model
{
    use HasFactory;
    protected $table = 'env_materials_categories';
    protected $fillable = [
        'category_title',
        'description',
        'quantity'
    ];
    public $timestamps = true;

    public function materials(){
        return $this->hasMany(ManufacturingMaterials::class, 'category_id');
    }
}
