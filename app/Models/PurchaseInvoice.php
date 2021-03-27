<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    use HasFactory;
    protected $table = 'purchase_invoice';
    public $timestamps = true;
    
    protected $fillable = [
        'p_invoice_id',
        'p_receipt',
        'date_created',
        'due_date_of_payment',
        'mode_payment',
        'paid_amount',
        'pi_status'
    ]; 
}