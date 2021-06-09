<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseReceipt extends Model
{
    use HasFactory;
    protected $table = 'purchase_receipt';
    public $timestamps = true;
    
    protected $fillable = [
        'p_receipt_id',
        'date_created',
        'purchase_id',
        'item_list_received',
        'grand_total',
        'pr_status'
    ]; 

    public function receivedMats() {
        $received_mats = json_decode($this->item_list_received);
        $received_mats_array = array();
        foreach($received_mats as $mat) {
            $item_code = $mat->item_code;
            $material = ManufacturingMaterials::where('item_code', $item_code)->first();
            $item_name = $material->item_name;
            array_push(
                $received_mats_array,
                array(
                    "item_code" => $item_code,
                    "item_name" => $item_name,
                    "qty" => $mat->qty_received,
                    "rate" => $mat->rate,
                    "amount" => $mat->amount,
                    "item_condition" => $mat->item_condition
                )
            );
        }
        return $received_mats_array;
    }

    public function noReceivedMaterials() {
        $materials = $this->order_record->items_list();
        foreach($materials as $material) {
            if($material['qty_received'] != 0) 
                return false;
        }
        return true;
    }

    public function order() {
        return $this->belongsTo(MaterialPurchased::class, 'purchase_id', 'purchase_id');
    }

    public function order_record() {
        return $this->hasOne(MaterialsOrdered::class, 'p_receipt_id', 'p_receipt_id');
    }

    public function invoice() {
        return $this->hasOne(PurchaseInvoice::class, 'p_receipt_id', 'p_receipt_id');
    }
}
