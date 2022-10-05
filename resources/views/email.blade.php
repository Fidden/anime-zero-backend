@component('mail::message')

<h1 style="text-align: center">Привет, {{ $user_name }}!</h1>

<h2 style="text-align: center; margin-bottom: 32px;">Чтобы подтвердить действительность своего электронного адреса учётной записи
AnimeZero, используйте код верификации ниже:</h2>

@component('mail::panel')
{{$code}}
@endcomponent

<p class="no-request">Если вы не указывали этот E-mail на сайте AnimeZero, то просто проигнорируйте данное письмо.</p>

<p class="regards">AnimeZero Team.</p>

@endcomponent
