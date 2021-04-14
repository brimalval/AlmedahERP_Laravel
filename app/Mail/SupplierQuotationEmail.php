<?php

namespace App\Mail;

use App\Models\MaterialQuotation;
use App\Models\Supplier;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Support\Facades\URL;

class SupplierQuotationEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $req_quotation_id;
    private $supplier;
    private $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($req_quotation_id, Supplier $supplier, $message="")
    {
        $this->req_quotation_id = $req_quotation_id;
        $this->supplier = $supplier;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.supplierquotation', [
            'link' => URL::signedRoute('supplierquotation.create', [
                'r' => $this->req_quotation_id,
                's' => $this->supplier->supplier_id,
            ]),
            'message' => $this->message,
            'contact' => $this->supplier->contact_name ?? $this->supplier->company_name,
        ]);
    }
}
