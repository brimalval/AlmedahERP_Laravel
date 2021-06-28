<?php

namespace App\Mail;

use App\Models\MaterialPurchased;
use App\Models\Supplier;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MaterialsPurchasedMail extends Mailable
{
    use Queueable, SerializesModels;
    private $supplier;
    private $mp_data;
    private $message1, $message2;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Supplier $supplier, MaterialPurchased $mp_data, $flag)
    {
        //
        $this->supplier = $supplier;
        $this->mp_data = $mp_data;

        if($flag == 0) { // cancel order
            $this->message1 = "We have decided to cancel our order for the following materials:";
            $this->message2 = "We hope that you can understand our decision.";
        } else {
            $this->message1 = "We would like to purchase the following materials:";
            $this->message2 = "We will be expecting these materials on or before the required date.";
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.materialpurchased', [
            'contact' => $this->supplier->company_name ?? $this->supplier->contact_name,
            'material_data' => $this->mp_data->itemsPurchased(),
            'message1' => $this->message1,
            'message2' => $this->message2
        ]);
    }
}
