<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillOfMaterials extends Model
{
    /**
     * These are not all the fields accdg to the schema. 
     * These are just the fields that are able to be entered for the meantime. 
     */
    use HasFactory;
    protected $table = "bom_bill_of_materials";
    public $timestamps = true;
    protected $fillable = [
        'product_code',
        'component_code',
        'routing_id',
        'purchase_id',
        'bom_name',
        'raw_material_cost', 
        'total_cost', 
        'is_active',
        'is_default'
    ]; 

    //public function getRates($id) {
    //    return BillOfMaterials::whereIn('id', json_decode($id));
    //} 

    public function routing(){
        return $this->hasOne(Routings::class, 'routings_id', 'routing_id');
    }

}
