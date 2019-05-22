@component('mail::message')

<h3>Reset password</h3>
<p>Hello {{$user->name}}</p>
<p>Your reset code is: </p>
<b>{{$user->code}}</b>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
