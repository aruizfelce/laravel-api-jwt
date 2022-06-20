@component('mail::message')
# Reinicio de contraseña

Ingrese al siguiente link para reiniciar su contraseña

@component('mail::button', ['url' => 'http://localhost:4200/response-password-reset?token='.$token])
Reinicias contraseña
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
