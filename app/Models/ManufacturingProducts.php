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
        'components',
    ];
    protected $casts = [
        'materials' => 'array',
        'components' => 'array',
    ];
    
    // Returns the product's materials & their respective quantities
    // as an array of arrays {{material_object1, qty}, {material_object2, qty}, etc.}
    // Expects that the json is formatted as {"0":{'material_id' : 'id', 'material_qty': 'qty'}, "1"...}
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

    // Returns the product's materials & their respective quantities
    // as an array of arrays {{component_object1, qty}, {component_object2, qty}, etc.}
    // Expects that the json is formatted as {"0":{'component_id' : 'id', 'component_qty': 'qty'}, "1"...}

    public function components(){
        $components = json_decode($this->components);
        $components_with_qty = array();
        foreach($components as $component){
            array_push($components_with_qty, array(
                'component' => Component::find($component->component_id),
                'qty' => $component->component_qty,
            ));
        }
        return $components_with_qty;
    }
}
