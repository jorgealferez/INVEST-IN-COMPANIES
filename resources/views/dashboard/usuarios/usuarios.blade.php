@extends('layouts.dashboard')
@section('content')

<div class="container-fluid">

    <div class="row">

        <div class="col-md-12">
            @include('dashboard.alertas')

            <div class="card">

                <div class="card-body">


                    <h4 class="card-title mb-0 title-section">
                        <i class="mdi mdi-account-multiple"></i>
                        {{ __('Listado de usuarios')}}

                        <a href="{{ e(route('dashboardUsuariosNuevo')) }}" class="btn btn-verde btn-sm float-right"><i class="fas fa-plus-circle text-white"></i> {{ __('Nuevo')}}</a>
                    </h4>

                </div>
                <hr class="mt-0">

                <div class="card-body">
                    <form method="POST" class="" action="{{  action('Dashboard\UsuariosController@index') }}" id="formSearch" name="formSearch">
                        @csrf @method('POST')
                        <input type="hidden" name="search" value="1">

                        <div class="table-responsive   no-wrap">
                            <table class="table table-striped table-hover tabla-usuarios">
                                <thead>
                                    <tr>

                                        <th>@sortablelink('name', __('Nombre'),[],['class'=>'text-nowrap'])<br>
                                            <input name="name" id="name" class=" typeahead" type="text" value="{{ (!empty($busqueda)) ? $busqueda->input('name') : '' }}" placeholder="{{ __('Nombre') }}">
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
                                    @if($usuarios->isNotEmpty())
                                    @foreach ($usuarios as $usuario)
                                    <?php
                                            // $usuarioRole= $usuario->roles->first()->name;
                                        ?>
                                    <tr>
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
                                            {{ e($usuario->FullName) }}
                                        </td>
                                        <td>{!! e($usuario->email) !!}</td>
                                        <td class="text-center">{!! e($usuario->phone) !!}</td>
                                        @if($isAdmin)
                                        <td>
                                            @foreach ($usuario->asociaciones as $asociacion)
                                            {{ e($asociacion->name) }}
                                            @endforeach
                                        </td>
                                        @endif
                                        <td class="text-right">
                                            <a href="<?php echo urldecode(route('dashboardUsuario',['usuario'=>$usuario])); ?>" class="text-verde" title="{{ __('Ver') }}">
                                                <i class="fas fa-eye text-verde"></i>
                                            </a>
                                            @if($usuario->asociacion_count==0 && $isAdmin)
                                            <a href="#" class=" borrarUsuario" data-toggle="modal" data-url="<?php echo urldecode(route('dashboardUsuarioDelete',['usuario'=>$usuario])); ?>" data-id="{{$usuario->id}}" data-name="{{$usuario->name}}" data-target="#custom-width-modal" title="{{ __('Eliminar') }}"> <i class="fas fa-window-close text-danger"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
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

<!-- Delete Model -->
<form method="POST" class="form-control-line form-material" action="" id="formBorrar">
    @csrf @method('POST')
    <input type="hidden" value="" name="usuario_id_borrar" id="usuario_id_borrar">

    <div id="borrar-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">

        <div class="modal-dialog" style="width:55%;">

            <div class="modal-content">

                <div class="modal-body">
                    <h4 id="texto-modal-borrar"></h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">{{ __('Cerrar') }}</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light" id="BotonEliminar">{{ __('Eliminar') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script src="{{ asset('js/bootstrap3-typeahead.min.js') }}" type="text/javascript"></script>

<script>
    $(document).on('click', '.borrarUsuario', function (e) {
        e.preventDefault();
        $('#texto-modal-borrar').html('Seguro que deseas borrar la asociación ' + ' <strong>' + $(this).data('name') + ' </strong>');
        $('#usuario_id_borrar').val($(this).data('id'));
        $('#BotonEliminar').on('click', function (e) {
            e.preventDefault();
            $('#formBorrar').attr('action', "/usuarios/delete/" + $('#usuario_id_borrar').val());
            $('#formBorrar').submit();
            $form = '';
        });
        $('#borrar-modal').modal('show');
    });

    $("#btnreset").click(function () {
        $("#formSearch").trigger("reset");
        $("#formSearch :input,#formSearch select").not('#formSearch input[type="hidden"]').val('');
        $("#formSearch").submit();
    });

</script>
@endsection
