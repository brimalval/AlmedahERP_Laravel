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

    public function mats_sold(){
        return $this
            ->hasManyThrough(
                 ManufacturingMaterials::class,
                 SupplierMats::class,
                'supplier_id',
                'item_code',
                'supplier_id',
                'item_code',
            );
    }

    // Used on RFQ for searching supplier by the items they sell
    public function supplier_tokens(){
        $tokens = "";
        foreach($this->mats_sold->pluck('item_name', 'item_code') as $item_code => $item_name){
            $tokens .= $item_code . " " . $item_name . " ";
        }
        return $tokens;
    }
}
