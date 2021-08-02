<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMoves extends Model
{
    use HasFactory;
    protected $table = 'stock_moves';
    public $timestamps = true;

    protected $fillable = [
        'tracking_id',
        'stock_moves_type',
        'mat_ordered_id',
        'move_date',
        'employee_id',
        'status'
    ]; 
}
