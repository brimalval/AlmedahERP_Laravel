<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialOrdered extends Model
{
    use HasFactory;
    protected $table = 'materials_ordered';
    public $timestamps = true;
    
    protected $fillable = [
        'mat_ordered_id',
        'p_receipt_id',
        'items_list_received',
        'mo_status'
    ]; 
}
