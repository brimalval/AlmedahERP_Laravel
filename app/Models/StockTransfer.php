<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransfer extends Model
{
    use HasFactory;
    protected $table = 'stock_transfer';
    public $timestamps = true;
    
    protected $fillable = [
        'tracking_id',
        'move_date',
        'item_code',
        'qty_transferred',
        'source_station',
        'target_station',
        'consumable',
        'item_condition',
        'transfer_status'

    ]; 
}
