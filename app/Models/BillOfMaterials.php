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
        'customer_id',
        'product_code',
        'bom_quantity',
        'unit',
        'rate_per_quantity',
        'bom_status',
        'currency',
        'is_active',
        'is_default',
        'total_cost',
        'allow_alternative_item',
        'set_rate_assembly_item',
        'total_cost'
    ]; 

    //public function getRates($id) {
    //    return BillOfMaterials::whereIn('id', json_decode($id));
    //} 

}
