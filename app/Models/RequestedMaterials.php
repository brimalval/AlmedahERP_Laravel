<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedMaterials extends Model
{
    use HasFactory;
    protected $table = 'requested_rm';
    public $timestamps = true;
    
    protected $fillable = [
        'request_id',
        'item_code',
        'quantity_requested',
        'station_id',
        'procurement_method'
    ]; 
}
