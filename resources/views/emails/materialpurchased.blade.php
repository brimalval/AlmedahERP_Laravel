@component('mail::message')
Greetings, {{ $contact }}!

{!! $message1 !!}

@component('mail::table')
| Item | Quantity |
| ---- | -------- |
@foreach ($material_data as $data)
| <center>{{ $data['item']->item_name }}</center> | <center>{{ $data['qty'] }}</center> |
@endforeach
@endcomponent

{!! $message2 !!}

With regards, <br>
{{ config('app.name') }}
@endcomponent
