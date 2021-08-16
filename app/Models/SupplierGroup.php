<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierGroup extends Model
{
    use HasFactory;
    protected $table = 'supplier_group';
    protected $fillable = [
        'supplier_id',
        'item_code'
    ];
    public $timestamps = false;
}
