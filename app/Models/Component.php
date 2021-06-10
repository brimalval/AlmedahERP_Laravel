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
    
    // Returns the component's materials & their respective quantities
    // as an array of arrays {{material_object1, qty}, {material_object2, qty}, etc.}
    // Expects that the json is formatted as {"0":{'material_id' : 'id', 'material_qty': 'qty'}, "1"...}
    public function materials(){
        $materials = json_decode($this->item_code);
        $materials_with_qty = array();
        foreach($materials as $material){
            array_push($materials_with_qty, array(
                'material' => ManufacturingMaterials::where('item_code', $material->item_code)->first(),
                'qty' => $material->item_qty,
            ));
        }
        return $materials_with_qty;
    }

    /**
     * Returns the latest default BOM of the component. If none exist,
     * the latest non-default BOM of the component is given.
     *
     * @return BillOfMaterials
     */
    public function bom(){
        $component_boms = BillOfMaterials::
            where('component_code','=', $this->component_code)
            ->where('is_default', '=', true)
            ->orderBy('created_at', 'DESC');
        if($component_boms->get()->count() == 0){
            $component_boms = BillOfMaterials::where(
                'component_code', '=', $this->component_code,
            )->orderBy('created_at', 'DESC');
        }
        return $component_boms->first();
    }
}
