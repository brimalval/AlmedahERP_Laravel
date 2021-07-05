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
        'stock_unit',
        'sale_supply_method',
        'reorder_level',
        'reorder_qty',
        'prototype',
        'manufacturing_date',
        'product_pulled_off_market'
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
            $raw_mat = ManufacturingMaterials::find($material->material_id);
            $uom = $raw_mat->uom;
            array_push($materials_with_qty, array(
                'material' => $raw_mat,
                'uom' => $uom,
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
    
    /**
     * Returns the latest default BOM of the product. If none exist, returns
     * the latest non-default BOM of the product.
     *
     * @return BillOfMaterials
     */
    public function bom(){
        $product_boms = BillOfMaterials::
            where('product_code','=', $this->product_code)
            ->where('is_default', '=', true)
            ->orderBy('created_at', 'DESC');
        if($product_boms->get()->count() == 0){
            $product_boms = BillOfMaterials::where(
                'product_code', '=', $this->product_code,
            )->orderBy('created_at', 'DESC');
        }
        return $product_boms->first();
    }
}
