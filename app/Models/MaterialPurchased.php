<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialPurchased extends Model
{
    use HasFactory;
    protected $table = 'materials_purchased';
    public $timestamps = true;
    protected $fillable = [
        'supplier_id',
        'item_code',
        'uom_id',
        'quantity_received',
        'purchase_date',
        'req_quotation_id',
        'mp_status'
    ];
}
