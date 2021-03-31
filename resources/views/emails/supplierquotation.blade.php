@component('mail::message')
Greetings, {{ $contact }}!

{!! $message !!}

@component('mail::button', ['url' => $link])
Go to Supplier Quotation
@endcomponent

If the above button does not work, click <a href="{{ $link }}">this link</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
