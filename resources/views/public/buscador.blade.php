@extends('layouts.public')
@section('contenido')


<div class="container-fluid my-3">

    <div class="row ">

        <div class="col-md-3">

            <div class="bg-primary p-3 text-center">
                <h3 class="text-uppercase text-white py-3 mx-auto ">{{ __('Filtros') }}</h3>
                <form method="POST" class="" action="{{ action('PublicController@buscador') }}">
                    @csrf @method('POST')


                    <div class="form-group ">
                        <label for="provincia_id" class="col-md-12 col-form-label text-white text-uppercase text-left">{{ __('Título') }}</label>

                        <div class="col-md-12">
                            <input name="name" id="name" class=" form-control" type="text" value="{{ (!empty($request)) ? $request->input('name') : '' }}" placeholder="{{ __('Nombre') }}">
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="provincia_id" class="col-md-12 col-form-label text-white text-uppercase text-left">{{ __('Asociación') }}</label>

                        <div class="col-md-12">
                            <select name="provincia_id" id="provincia_id" class="form-control ">
                                <option value="0">{{ __('Todas') }}</option>
                                @foreach ($asociaciones as $asociacion)
                                <option value="{{ $asociacion->id }}" @if ($request->input('asociacion_id')== $asociacion->id) selected @endif>{{ $asociacion->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group ">
                        <label for="provincia_id" class="col-md-12 col-form-label text-white text-uppercase text-left">{{ __('Provincia') }}</label>

                        <div class="col-md-12">
                            <select name="provincia_id" id="provincia_id" class="form-control ">
                                <option value="0">{{ __('Todas') }}</option>
                                @foreach ($provincias as $provincia)
                                <option value="{{ $provincia->id }}" @if ($request->input('provincia_id')== $provincia->id) selected @endif>{{ $provincia->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="sector_id" class="col-md-12 col-form-label text-white text-uppercase text-left">{{ __('Sector') }}</label>

                        <div class="col-md-12">
                            <select name="sector_id" id="sector_id" class="form-control ">
                                <option value="0">{{ __('Todos') }}</option>
                                @foreach ($sectores as $sector)
                                <option value="{{ $sector->id }}" @if ($request->input('sector_id')== $sector->id) selected @endif>{{ $sector->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="precio" class="col-md-12 col-form-label text-white text-uppercase text-left">{{ __('Precio') }}</label>

                        <div class="col-md-12">
                            <select name="precio" id="precio" class="form-control ">
                                <option value="0">{{ __('Selecciona cantidad') }}</option>
                                @foreach ($precios as $precio)
                                <option value="{{ $precio->value }}" @if ($request->input('precio')== $precio->value) selected @endif>{{ $precio->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group my-5">
                        <button class="btn-invest  bg-transparent text-uppercase fa-1x " type="submit">{{ __('Aplicar') }}</button>
                    </div>
            </div>
            </form>
        </div>


        <div class="col-md-9 pl-md-0 mt-md-0 mt-sm-3" style="min-height: 750px;">
            <table class="table table-striped table-hover">
                <thead class="thead-primary">
                    <tr>
                        <th scope="col">@sortablelink('sector', __('Sector'))</th>
                        <th scope="col">@sortablelink('name', __('Nombre'))</th>
                        <th scope="col" class="text-right">@sortablelink('valoracion', __('Valoracion'))</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($ofertas->count()>0)
                    @foreach ($ofertas as $oferta)
                    <tr aria-controls="collapse{{ $oferta->id }}" data-toggle="collapse" data-target="#collapse{{ $oferta->id }}" class="collapse-row">
                        <td style="width: 30%">{{ e($oferta->sector_name) }}</td>
                        <td style="width: 50%">{{ e($oferta->name) }}</td>
                        <td style="width: 20%" class="text-right">
                            {{ number_format($oferta->valoracion,0,'','.') }} €
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" style="padding:0px;">

                            <div class="collapse oferta-detalle" id="collapse{{ $oferta->id }}">

                                <div class="card card-profile">

                                    <div class="card-body ">
                                        <h6 class="card-subtitle  m-0">{{ e($oferta->descripcion) }}</h6>
                                    </div>

                                    <hr class=" verde">

                                    <div class="card-body row">

                                        <div class="col-md-8  ">
                                            <small class=" font-weight-bold verde">{{ __('Forma Jurídica') }}:</small>
                                            <h6>{{ e($oferta->forma->name) }}</h6>
                                        </div>

                                        <div class="col-md-4">
                                            <small class="verde font-weight-bold">{{ __('CIF') }}:</small>
                                            <h6>{{ e($oferta->cif) }}</h6>
                                        </div>


                                        <div class="col-md-4 ">
                                            <small class=" font-weight-bold verde">{{ __('Socios') }}:</small>
                                            <h6>{{ e($oferta->socios) }}</h6>
                                        </div>

                                        <div class="col-md-4 ">
                                            <small class=" font-weight-bold verde">{{ __('Empleados') }}:</small>
                                            <h6>{{ e($oferta->empleados) }}</h6>
                                        </div>

                                        <div class="col-md-4 ">
                                            <small class=" font-weight-bold verde">{{ __('Año') }}:</small>
                                            <h6>{{ e($oferta->año) }}</h6>
                                        </div>

                                        <div class="col-md-12">
                                            <hr class=" verde">
                                        </div>
                                        @if ($oferta->motivo)

                                        <div class="col-md-12">
                                            <small class=" font-weight-bold verde">{{ __('Motivo') }}:</small>
                                            <h6>{{ e($oferta->motivo) }}</h6>
                                        </div>
                                        @endif

                                        <div class="col-md-6">
                                            <small class=" font-weight-bold verde">{{ __('Sector') }}:</small>
                                            <h6>{{ e($oferta->sector->name) }}</h6>
                                        </div>

                                        <div class="col-md-6 ">
                                            <small class=" font-weight-bold verde">{{ __('Local propio') }}:</small>
                                            <h6>{{ ($oferta->local)? 'Si':'No' }}</h6>
                                        </div>

                                        <div class="col-md-12">
                                            <hr class=" verde">
                                        </div>

                                        <div class="col-md-6">
                                            <small class=" font-weight-bold verde">{{ __('Direccion') }}:</small>
                                            <h6>{{ e($oferta->address) }}, {{ e($oferta->poblacion->name) }} ({{ e($oferta->provincia->name) }})</h6>
                                        </div>

                                        <div class="col-md-6">
                                            <small class=" font-weight-bold verde">{{ __('Página web') }}:</small>
                                            <a href="{{ urldecode($oferta->web) }}" class="link text-muted" target="_blank">
                                                <h6>{{ e($oferta->web) }}</h6>
                                            </a>
                                        </div>


                                        <div class="col-md-12">
                                            <hr class=" verde">
                                        </div>

                                        <div class="col-md-6">
                                            <small class=" font-weight-bold verde">{{ __('Valoración de la compañía') }}:</small>
                                            <h6>{{ number_format($oferta->valoracion,0,'','.') }} €</h6>
                                        </div>

                                        <div class="col-md-6">
                                            <small class=" font-weight-bold verde">{{ __('Endeudamiento') }}:</small>
                                            <h6 class="text-danger">{{ number_format($oferta->endeudamiento,0,'','.') }} €</h6>
                                        </div>
                                    </div>
                                    <hr class="m-0 verde">

                                    <div class="card-body row">

                                        <div class="col-md-4 ">
                                            <small class="verde">{{ __('Contacto') }}:</small>
                                            <h6><i class="ti-user"></i> {{ e($oferta->contactFullName) }}</h6>
                                        </div>

                                        <div class="col-md-4 ">
                                            <small class="verde">{{ __('Email') }}:</small>
                                            <a href="mailto:{{ e($oferta->contactEmail) }}" class="link text-muted" target="_blank">
                                                <h6><i class="ti-email"></i> {{ e($oferta->contactEmail) }}</h6>
                                            </a>
                                        </div>

                                        <div class="col-md-4 ">
                                            <small class="verde">{{ __('Teléfono') }}:</small>
                                            <h6><i class="ti-mobile"></i> {{ e($oferta->contactPhone) }}</h6>
                                        </div>
                                    </div>

                                    <hr class="m-0">

                                    <div class="card-body row">

                                        <div class="col-md-12 ">
                                            @if ($invitado)
                                            <button class="btn btn-success waves-effect waves-light invitado" data-id="{{ e($oferta->id) }}">{{ __('Solicitar información') }}</button>
                                            @else

                                            @if (!in_array($oferta->id,$inversiones))
                                            <button class="btn btn-success waves-effect waves-light informacion" data-id="{{ e($oferta->id) }}">{{ __('Solicitar información') }}</button>
                                            @else
                                            <button class="btn btn-info waves-effect waves-light ">{{ __('Información solicitada') }}</button>
                                            @endif
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="3">
                            <small>{{ __('No hay ofertas con esos criterios.') }}</small>
                        </td>
                    </tr>
                    @endif

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <span class="d-inline-block float-right">
                                {{ $ofertas->appends(
                                            Request::except('page'))
                                            ->links() }}
                            </span>
                        </td>
                        <td class="text-right">

                            <small>
                                <strong>
                                    ({{ $ofertas->total() }})
                                </strong>
                                @if ($ofertas->total()>1)
                                {{ __(' Ofertas encontradas.') }}
                                @elseif($ofertas->total()==1)
                                {{ __(' Oferta encontrada.') }}
                                @endif
                            </small>
                        </td>
                    </tr>
                </tfoot>
            </table>


        </div>
    </div>

</div>
@include('public.modal')
@endsection

@section('scripts')
<script>
    $(document).ready(function ($) {
        $('.collapse-row').on("click", function (event) {
            $(this).addClass('bg-verde');
        });

        $('.oferta-detalle').on("show.bs.collapse", function (event) {
            $('.oferta-detalle').not(this).collapse('hide');
        });
        $('.oferta-detalle').on("hidden.bs.collapse", function (event) {
            $('.collapse-row').not('.collapse-row[aria-expanded="true"]').removeClass('bg-verde');
        });

        $('.informacion').one('click', function (e) {
            var $boton = $(this);
            $.ajax({
                url: "{{ route('inversion') }}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "oferta_id": $(this).data('id')
                },
                success: function (data) {
                    if (data.status) {
                        $boton.removeClass(['informacion', 'btn-success']).addClass('btn-info');
                        $boton.html('{{ __("Información solicitada")}}');
                        $boton.unbind('click');
                        $('#titular-modal').html('Información solicitada');
                        $('#texto-modal').html('Has solicitado información de la oferta, en breve recibirás un correo de información y nos pondremos en contacto contigo.');
                        $('#Modal').modal('show');
                    } else {
                        alert('Error');
                    }

                }
            });
        });

        $('.invitado').on('click', function (e) {
            $('#ModalInvitado').modal('show');
        });

    });

</script>
@endsection
