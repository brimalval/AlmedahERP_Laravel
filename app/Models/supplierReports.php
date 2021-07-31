<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplierReports extends Model
{
    use HasFactory;
    protected $table = 'supplier_reports';
    public $timestamps = true;
    protected $fillable = [
        'supp_quotation_id',
        'supplier_id',
        'item_code',
        'rate',
        'date_created'
    ];
}
