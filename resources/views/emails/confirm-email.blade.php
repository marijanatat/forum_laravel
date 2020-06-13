@component('mail::message')
# And you have to

Please, confirm your email adress

@component('mail::button', ['url' => url('/register/confirm?token=' . $user->confirmation_token)])
Confirm email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
