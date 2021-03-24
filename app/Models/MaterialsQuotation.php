<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialQuotation extends Model
{
    use HasFactory;
    protected $table = 'request_quotation';
    public $timestamps = true;
    
    protected $fillable = [
        'req_quotation_id',
        'date_created',
        'request_id',
        'item_list',
        'req_status'
    ]; 

    public function getRQEntry() {
        return $this->hasOne(RequestQuotationSuppliers::class, 'req_quotation_id', 'req_quotation_id');
    }

    public function getRequest() {
        return $this->belongsTo(MaterialRequest::class, 'request_id', 'request_id');
    }
}
