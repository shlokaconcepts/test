@component('mail::message')
# Dear  {{$details['name']}},

<p>Your job application for <strong> {{$details['category']}}  {{$details['company_name']}} </strong> successfully received. Your Registration ID is <strong> {{$details['unique_id']}}.</strong></p>
<p>To check your application status, click to login btn</p>
@component('mail::button', ['url' => url('login')])
Login
@endcomponent

<p>Please keep checking your email for further updates.</p>
Thanks,<br>
# {{ env('APP_NAME') }},
@endcomponent
@slot('footer')
    @component('mail::footer')
        © {{ date('Y') }} {{ env('APP_NAME') }}. @lang('All rights reserved.')
    @endcomponent
@endslot
