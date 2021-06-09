<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialsOrdered extends Model
{
    use HasFactory;
    protected $table = 'materials_ordered';
    public $timestamps = true;

    protected $fillable = [
        'mat_ordered_id',
        'p_receipt_id',
        'items_list_received',
        'mo_status'
    ];

    public function items_list()
    {
        $items = json_decode($this->items_list_received, true);
        //var_dump($items);
        $order = $this->p_receipt->order;
        $ordered_mats = $order->itemsPurchased();
        $i = 0;
        $items_list_received = array();
        foreach ($ordered_mats as $item) {
            if ($items[$i]['item_code'] === $item['item']->item_code) {
                array_push(
                    $items_list_received,
                    array(
                        'material' => ManufacturingMaterials::where('item_code', $item['item']->item_code)->first(),
                        'qty_received' => $items[$i]['qty_received'],
                        'qty_ordered' =>  $item['qty'],
                        'curr_progress' => intval(($items[$i]['qty_received']/$item['qty'])*100)
                    )
                );
                ++$i;
            }
        }
        return $items_list_received;
    }

    public function p_receipt()
    {
        return $this->belongsTo(PurchaseReceipt::class, 'p_receipt_id', 'p_receipt_id');
    }
}
