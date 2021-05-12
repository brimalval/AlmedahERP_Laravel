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
        'sq_status',
        'supplier_id',
    ]; 

    public $casts = [
        'date_created' => 'date',
    ];

    public function items(){
        $itemsString = $this->items_list_rate_amt;
        $itemsJSON = json_decode($itemsString);
        foreach($itemsJSON as $item){
            $item->item = ManufacturingMaterials::where('item_code', '=', $item->item_code)->first();
            $item->uom = MaterialUOM::where('uom_id', '=', $item->uom_id)->first();
        }
        return $itemsJSON;
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }

    public function req_quotation() {
        return $this->belongsTo(MaterialQuotation::class, 'req_quotation_id', 'req_quotation_id');
    }
    // public function getPurchasedMaterials() {
    //     return $this->hasOne(MaterialPurchased::class, 'supp_quotation_id', 'supp_quotation_id');
    // }

    public function getRouteKeyName(){
        return 'supp_quotation_id';
    }

    public function archive(){
        $rfq = $this->req_quotation;
        $mr = $rfq->material_request;

        $this->sq_status = "Archived";
        $rfq->req_status = "Archived";
        $mr->mr_status = "Archived";
    }
}
