<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentInvoiceLog extends Model
{
    use HasFactory;
    protected $table = 'purchase_invoice_logs';
    public $timestamps = true;
    
    protected $fillable = [
        'pi_logs_id',
        'pi_invoice_id',
        'date_of_payment',
        'payment_method',
        'payment_description',
        'amount_paid',
        'account_no',
        'cheque_no',
    ];

    public function invoice() {
        return $this->belongsTo(PurchaseInvoice::class, 'p_invoice_id', 'p_invoice_id');
    }
}
