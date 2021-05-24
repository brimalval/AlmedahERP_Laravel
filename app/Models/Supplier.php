<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    public $timestamps = true;
    protected $fillable = [
        'supplier_id',
        'company_name',
        'supplier_group',
        'contact_name',
        'phone_number',
        'supplier_email',
        'supplier_address'
    ];

    public function request_quotations() {
        return $this
            ->hasManyThrough(
                MaterialQuotation::class,
                RequestQuotationSuppliers::class,
                'supplier_id',
                'req_quotation_id',
                'supplier_id',
                'req_quotation_id',
            );
    }
}
