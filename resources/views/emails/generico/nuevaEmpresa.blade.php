@component('mail::message')
Hola, **{{ $usuario->name }}**

Se ha recibido una solicitud de contacto para dar de alta una empresa con los siguientes datos de contacto.


* **{{ $empresaNombre }}**
*  {{ $empresaEmail }}
*  {{ $empresaPhone }}

Puedes acceder a la Plataforma desde el siguiente enlace:

@component('mail::button', ['url' => url(config('app.url').'/dashboard'),'color'=>'verde'])
ACCEDER
@endcomponent


@component('mail::subcopy')
Aprovechamos este correo electrónico para recordarte que nuestro soporte técnico está disponible las 24 horas del día para cualquier duda o problema que puedas tener en [{{ config('app.email') }}](mailto:{{ config('app.email') }})

@endcomponent

@endcomponent