@component('mail::message')
# Hello {{ $quotation->client->client_name }},

Please find attached your quotation for the requested products/services.

**Total Amount:** K{{ number_format($quotation->grand_total, 2) }}

If you have any questions or wish to proceed, feel free to reply to this email.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
