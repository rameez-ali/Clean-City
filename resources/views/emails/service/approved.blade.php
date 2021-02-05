@component('mail::message')
# Service Approved

Your service has been {{$data->status}}

id: {{$data->id}}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
