<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovesReturn extends Model
{
    use HasFactory;
    protected $table = 'stock_return';
    
    protected $fillable = [
        'tracking_id',
        'item_code',
        'return_date',
        'return_status'
    ]; 
}
