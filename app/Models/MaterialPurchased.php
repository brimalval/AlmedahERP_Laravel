<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialPurchased extends Model
{
    use HasFactory;
    protected $table = 'materials_purchased';
    public $timestamps = true;
    protected $fillable = [
        'purchase_id',
        'supp_quotation_id',
        'items_list_purchased',
        'purchase_date',
        'mp_status',
        'total_cost'
    ];

    protected $casts = [
        'items_list_purchased' => 'array'
    ];

    public function itemsPurchased() {
        $items_purchased = json_decode($this->items_list_purchased);
        // sometimes, one json_decode is not enough to convert json string to json object
        while(gettype($items_purchased) === 'string') {
            $items_purchased = json_decode($items_purchased);
        }
        $items_purchased_array = array();
        foreach($items_purchased as $item) {
            array_push($items_purchased_array,
                array(
                    'item_code' => $item->item_code,
                    'req_date' => $item->req_date,
                    'qty' => $item->qty,
                    'rate' => $item->rate,
                    'subtotal' => $item->subtotal
                )
            );
        }
        return $items_purchased_array;
    }

    public function supplier_quotation() {
        return $this->belongsTo(SuppliersQuotation::class, 'supp_quotation_id', 'supp_quotation_id');
    }

    public function receipt() {
        return $this->hasOne(PurchaseReceipt::class, 'purchase_id', 'purchase_id');
    }
}
