@component('mail::message')
Hola, **{{ $usuario->name }}**

**¡Te damos la bienvenida a la Plataforma INVESTin Companies!**

Tu cuenta ha sido creada correctamente y ya puedes acceder a tu área privada para gestionar tu perfil, utilizar nuestras
herramientas y añadir, modificar o borrar los diferentes proyectos de compra, venta o ampliación de capital, utilizando la
siguiente cuenta:

- Correo eletrónico: {{ $usuario->email }}

@component('mail::button', ['url' => url(config('app.url').'/dashboard'),'color'=>'verde'])
ACCEDER
@endcomponent

@component('mail::subcopy')
Aprovechamos este correo electrónico para recordarte que nuestro soporte técnico está disponible las 24 horas del día para cualquier duda o problema que puedas tener en [{{ config('app.email') }}](mailto:{{ config('app.email') }})
@endcomponent

@endcomponent
