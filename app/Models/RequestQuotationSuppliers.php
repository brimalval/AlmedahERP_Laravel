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
        'supplier_id',
    ]; 

    public function request_quotation(){
        return $this->belongsTo(MaterialQuotation::class, 'req_quotation_id', 'req_quotation_id');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }
}
