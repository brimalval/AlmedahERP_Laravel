<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialRequest extends Model
{
    use HasFactory;
    protected $table = 'env_material_requests';
    public $timestamps = true;
    
    protected $fillable = [
        'request_id',
        'item_code',
        'quantity',
        'required_date',
        'reorder_id',
        'purpose_id',
        'uom_id',
        'station_id'
    ]; 
}
