@extends('layouts.dashboard')
@section('content')

<div class="container-fluid">

    <div class="row">

        <div class="col-md-12">
    @include('dashboard.alertas')

            <div class="card">

                <div class="card-body">


                    <h4 class="card-title mb-0 title-section">
                        <span class="lstick"></span> {{ __('Listado de usuarios')}}
                        <a href="{{ e(route('dashboardUsuariosNuevo')) }}" class="btn btn-verde btn-sm float-right"><i class="fas fa-plus-circle text-white"></i> {{ __('Nuevo')}}</a>
                    </h4>

                </div>
                <hr class="mt-0">

                <div class="card-body">
                    <form method="POST" class="" action="{{  action('Dashboard\UsuariosController@index') }}" id="formSearch" name="formSearch">
                        @csrf @method('POST')
                        <input type="hidden" name="search" value="1">

                        <div class="table-responsive   no-wrap">
                            <table class="table  table-hover tabla-usuarios">
                                <thead>
                                    <tr>

                                        <th>@sortablelink('name', __('Nombre'),[],['class'=>'text-nowrap'])<br>
                                            <input name="name" id="name" class=" typeahead" type="text" value="{{ (!empty($busqueda)) ? $busqueda->input('name') : '' }}"
                                                placeholder="{{ __('Nombre') }}">
                                        </th>
                                        <th>@sortablelink('email', __('Email'),[],['class'=>'text-nowrap'])<br>
                                            <input name="email" id="email" class="" type="text" value="{{ (!empty($busqueda)) ? $busqueda->input('email') : '' }}" placeholder="{{ __('Email') }}">
                                        </th>
                                        <th>@sortablelink('phone', __('Teléfono'),[],['class'=>'text-nowrap'])<br>
                                            <input name="phone" id="phone" class="" type="text" value="{{ (!empty($busqueda)) ? $busqueda->input('phone') : '' }}" placeholder="{{ __('Teléfono') }}">
                                        </th>

                                        @if($isAdmin)
                                        <th>@sortablelink('asociacion', __('Asociación'),[],['class'=>'text-nowrap'])<br>
                                            <select name="asociacion_id" id="asociacion_id" class="">
                                                <option value="">{{ __('Todas') }}</option>
                                                @foreach ($asociacionesDisponibles as $asociacion)
                                                <option value="{{ $asociacion->id }}" @if ( (!empty($busqueda)) && $asociacion->id==$busqueda->input('asociacion_id'))
                                                    selected
                                                    @endif
                                                    class="">{{$asociacion->name }}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        @endif
                                        <th>

                                            <div class="btn-group btn-group-toggle">
                                                <button type="submit" class="btn btn-verde-alt  btn-sm">{{ __('Buscar') }}</button>
                                                <button type="button" class="btn btn-secondary btn-sm" id="btnreset">{{ __('Todas') }}</button>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($usuarios->isNotEmpty()) @foreach ($usuarios as $usuario)
                                    <?php
                                            // $usuarioRole= $usuario->roles->first()->name;
                                        ?>
                                        <tr class="@if(!$usuario->active) registro-eliminado @endif">
                                            <?php /*   <td>

                                                <div class="message-box contact-box">

                                                    <div class="message-widget contact-widget">

                                                        <div class="user-img " style="">

                                                            <span class="badge role{{ substr($usuarioRole,0,2) }} btn-sm text-white">{{ $usuarioRole }}</span>
                                                            <span class="profile-status {{ $usuario->statusClass() }} pull-left" style="left:-7px;top:-2px;"></span>

                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td> */ ?>
                                            <td>
                                                @if (in_array($usuario->id, $notifiacionesUsuarios->pluck('data')->pluck('usuario_id')->toArray()))
                                                <span class="badge badge-success bg-warning">
                                                                                                                                            {{ __('Nuevo') }}</span>                                                @endif {{ e($usuario->FullName) }}

                                            </td>
                                            <td>{!! e($usuario->email) !!}</td>
                                            <td class="text-center">{!! e($usuario->phone) !!}</td>
                                            @if($isAdmin)
                                            <td>
                                                @foreach ($usuario->asociaciones as $asociacion) {{ e($asociacion->name) }}<br>                                                @endforeach
                                            </td>
                                            @endif
                                            <td class="text-right">

                                                <div class="btn-group" role="group" aria-label="...">
                                                    <a href="<?php echo urldecode(route('dashboardUsuario',['usuario'=>$usuario])); ?>" class="btn btn-sm btn-secondary" title="{{ __('Ver') }}">
                                                    {{ __('Ver') }}
                                                </a> @if($isAdmin ) @if($usuario->active)
                                                    <a href="#" title="{{ __('Eliminar') }}" data-toggle="modal" data-original-title="{{ __('Borrar') }}" class="btn btn-sm btn-danger  borrarUsuario "
                                                        data-url="<?php echo urldecode(route('dashboardOfertaDelete',['usuario'=>$usuario])); ?>"
                                                        data-id="{{$usuario->id}}" data-name="{{$usuario->name}}" data-target="#borrarModal"
                                                        data-borrar="1">
                                                    <i class="fa fas fa-trash"></i>
                                                </a> @else
                                                    <a href="#" title="{{ __('Restablecer') }}" data-toggle="modal" data-borrar="0" data-original-title="{{ __('Restablecer') }}"
                                                        class="borrarUsuario  btn btn-sm btn-success" data-url="<?php echo urldecode(route('dashboardUsuarioDelete',['usuario'=>$usuario])); ?>"
                                                        data-id="{{$usuario->id}}" data-name="{{$usuario->name}}" data-target="#borrarModal">
                                                    <i class="fa  fas fa-undo-alt"></i>
                                                </a> @endif @endif
                                                </div>


                                            </td>
                                        </tr>
                                        @endforeach @else
                                        <tr>
                                            <td colspan="5">
                                                <p>{{ __('No hay resultados disponibles') }}</p>
                                            </td>
                                        </tr>
                                        @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3">{{ $usuarios->appends(request()->query())->links() }}</td>
                                        <td colspan="2" class="text-right">
                                            @if ($usuarios->total()>=1)
                                            <small>
                                                <strong>
                                                    {{ $usuarios->total() }}
                                                </strong>
                                                @if ($usuarios->total()>=1)
                                                {{ __(' usuarios encontrados') }}
                                                @elseif($usuarios->total()==1)
                                                {{ __(' usuarios encontrado') }}
                                                @endif
                                            </small> @endif
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>

</div>
    @include('dashboard.modalBorrar')
@endsection

@section('scripts') {{--
<script src="{{ asset('js/bootstrap3-typeahead.min.js') }}" type="text/javascript"></script> --}}

<script>
    $(document).ready(function ($) {
        $('#borrarModal').on("show.bs.modal", function (event) {
            if (!$(event.relatedTarget).data('borrar')) {
                $('#modalborrar_action').val('1');
                $("#BotonEliminar").removeClass("btn-danger").addClass("btn-success").html('Restablecer');
                $('#texto-modal-borrar').html('Seguro que deseas volver a activar el usuario ' + ' <strong>' + $(event.relatedTarget).data('name') + ' </strong>');
            } else {
                $('#modalborrar_action').val('0');
                $("#BotonEliminar").removeClass("btn-success").addClass("btn-danger").html('Eliminar');
                $('#texto-modal-borrar').html('Seguro que deseas borrar el usuario ' + ' <strong>' + $(event.relatedTarget).data('name') + ' </strong>');
            }

            $('#id_borrar').val($(event.relatedTarget).data('id'));
            $('#BotonEliminar').on('click', function (e) {
                $('#formBorrar').attr('action', "/dashboard/usuarios/delete/" + $('#id_borrar').val());
                $('#formBorrar').submit();
                $form = '';
            });
        });

    });

    $("#btnreset").click(function () {
        $("#formSearch").trigger("reset");
        $("#formSearch :input,#formSearch select").not('#formSearch input[type="hidden"]').val('');
        $("#formSearch").submit();
    });

</script>
@endsection
