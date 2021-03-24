<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestQuotationSuppliers extends Model
{
    use HasFactory;
    protected $table = 'rq_suppliers';
    public $timestamps = true;
    
    protected $fillable = [
        'req_quotation_id',
        'suppliers_id'
    ]; 
}
