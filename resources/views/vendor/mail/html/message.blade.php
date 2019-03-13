@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')

![](data:image/png;base64,{{base64_encode(file_get_contents(public_path('/images/logo-light-text.png')))}} "Invest In Companies")

@2018 Copyright. Todos los derechos reservados por tu empresa

@endcomponent
@endslot
@endcomponent