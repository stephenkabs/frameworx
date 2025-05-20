<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PayslipMail extends Mailable
{
    use Queueable, SerializesModels;

    public $payslip;
    public $pdf;

    public function __construct($payslip, $pdf)
    {
        $this->payslip = $payslip;
        $this->pdf = $pdf;
    }

    public function build()
    {
        return $this->subject('Your Monthly Payslip')
            ->markdown('emails.payslip')
            ->attachData($this->pdf->output(), $this->payslip->worker->name . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
