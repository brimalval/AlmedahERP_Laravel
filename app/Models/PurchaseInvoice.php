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
        'p_receipt_id',
        'date_created',
        'total_amount_paid',
        'payment_balance',
        'payment_mode',
        'grand_total',
        'pi_status'
    ]; 

    public function receipt() {
        return $this->belongsTo(PurchaseReceipt::class, 'p_receipt_id', 'p_receipt_id');
    }

    public function invoice_logs() {
        return $this->hasMany(PaymentInvoiceLog::class, 'p_invoice_id', 'p_invoice_id');
    }
}
