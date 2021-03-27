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
        'items_list_received',
        'grand_total',
        'pr_status'
    ]; 
}