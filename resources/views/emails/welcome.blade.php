@component('mail::message')
# Welcome, {{ $user->name }}!

We're excited to have you at **AwCloud Technologies Inc.**
Your account has been successfully created.

@component('mail::button', ['url' => url('/')])
Get Started
@endcomponent

If you have any questions, just reply to this email — we’re always happy to help.

Thanks,
{{ config('app.name') }}
@endcomponent
