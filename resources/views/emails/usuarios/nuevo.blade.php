@component('mail::message')
Hola, **{{ $usuario->name }}**

La cuenta de usuario ** [{{ $nuevo->email }}](mailto:{{ $nuevo->email }})** ha sido creada. Te recordamos que puedes modificarla o borrarla accediendo con tu cuenta de administrador.

Puedes acceder a la Plataforma desde el siguiente enlace:

@component('mail::button', ['url' => '/dashboard/usuarios','color'=>'verde'])
ACCEDER
@endcomponent


@component('mail::subcopy')
Aprovechamos este correo electrónico para recordarte que nuestro soporte técnico está disponible las 24 horas del día para cualquier duda o problema que puedas tener en [{{ config('app.email') }}](mailto:{{ config('app.email') }})

@endcomponent

@endcomponent