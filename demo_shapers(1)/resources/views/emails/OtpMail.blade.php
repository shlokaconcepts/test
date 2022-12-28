@component('mail::message')
# Hi there,


Use the following one-time password (OTP) to sign in to your {{ env('APP_NAME') }} account.
This OTP will be valid for next 5 minutes <b>{{$details['otp_expire_time'] }}</b>

# {{$details['otp']}}

Regards<br>
# {{ env('APP_NAME') }} Team,
<a href="{{url('/')}}">{{url('/')}}</a>
@endcomponent
