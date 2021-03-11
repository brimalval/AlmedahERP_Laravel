<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturingProducts extends Model
{
    use HasFactory;
    protected $table = 'man_products';
    public $timestamps = true;
    protected $fillable = [
        'product_code',
        'product_name',
        'product_status',
        'product_type',
        'product_category',
        'sales_price_wt',
        'picture',
        'unit',
        'internal_description',
        'bar_code',
        'picture',
        'materials',
    ];
    protected $casts = [
        'materials' => 'array',
    ];
    
    // Returns the product's materials & their respective quantities
    // as an array of arrays {{material_object1, qty}, {material_object2, qty}, etc.}
    public function materials(){
        $materials = json_decode($this->materials);
        $materials_with_qty = array();
        foreach($materials as $material){
            array_push($materials_with_qty, array(
                'material' => ManufacturingMaterials::find($material->material_id),
                'qty' => $material->material_qty,
            ));
        }
        return $materials_with_qty;
    }
}
