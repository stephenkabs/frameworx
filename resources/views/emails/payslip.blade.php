@component('mail::message')
# Hello {{ $payslip->worker->name }},

Your payslip for the period of **{{ \Carbon\Carbon::parse($payslip->date)->format('F Y') }}** has been generated.

You can find your payslip attached as a PDF.

If you have any questions, please contact HR.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
