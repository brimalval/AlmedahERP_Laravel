<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialQuotation extends Model
{
    use HasFactory;
    protected $table = 'materials_quotation';
    public $timestamps = true;
    
    protected $fillable = [
        'req_quotation_id',
        'date_created',
        'request_id',
        'item_list',
        'req_status'
    ]; 
}
