<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuotationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $quotation;
    public $pdf;

    public function __construct($quotation, $pdf)
    {
        $this->quotation = $quotation;
        $this->pdf = $pdf;
    }

    public function build()
    {
        return $this->subject('Your Quotation from ' . config('app.name'))
            ->markdown('emails.quotation')
            ->attachData($this->pdf->output(), $this->quotation->client->client_name . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}

