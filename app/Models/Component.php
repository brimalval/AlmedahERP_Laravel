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

    // public function raw_material(){
    //     return $this->hasOne(ManufacturingMaterials::class, 'item_code', 'item_code');
    // }
    
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
