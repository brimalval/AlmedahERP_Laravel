<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuppliersQuotation extends Model
{
    use HasFactory;
    protected $table = 'suppliers_quotation';
    public $timestamps = true;
    
    protected $fillable = [
        'supp_quotation_id',
        'date_created',
        'req_quotation_id',
        'items_list_rate_amt',
        'grand_total',
        'remarks',
        'sq_status'
    ]; 

    public function getPurchasedMaterials() {
        return $this->hasOne(MaterialPurchased::class, 'supp_quotation_id', 'supp_quotation_id');
    }
}
