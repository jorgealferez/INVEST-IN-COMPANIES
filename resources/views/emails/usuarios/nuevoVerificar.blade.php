@component('mail::message')
Hola, **{{ $usuario->name }}**

**¡Te damos la bienvenida a la Plataforma INVESTin Companies!**

Tu registro se ha procesado correctamente. Ya sólo falta que actives tu cuenta en el siguiente enlace:

@component('mail::button', ['url' => $url,'color'=>'verde'])
ACTIVAR CUENTA
@endcomponent


@component('mail::subcopy')
Aprovechamos este correo electrónico para recordarte que nuestro soporte técnico está disponible las 24 horas del día para cualquier duda o problema que puedas tener en [{{ config('app.email') }}](mailto:{{ config('app.email') }})

@endcomponent

@endcomponent