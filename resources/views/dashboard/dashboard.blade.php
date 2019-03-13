@extends('layouts.dashboard')
@section('content')

<div class="container-fluid r-aside">
    @if (session('status'))

    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button> {{ session('status') }}
    </div>
    @endif
    <div class="row">
        <?php
        use Carbon\Carbon; ?>

        <div class="col-md-6">

            <div class="card">

                <div class="card-body card-seccion-asociaciones">
                    <h4 class="card-title mb-0 title-section">
                        <span class="lstick"></span> {{ __('Solicitudes de Empresa')}}
                    </h4>
                </div>
                <hr class="mt-0">

                <div class="card-body">
                    <form method="POST" class="" action="{{ e(route('dashboardAsociaciones')) }}" id="formSearch">
                        @csrf @method('POST')
                        <input type="hidden" name="search" value="1">

                        <div class="table-responsive ">
                            <table class="table  table-hover tabla-usuarios">
                                <thead>
                                    <tr>
                                        <th>
                                            {{ __('Nombre') }}
                                        </th>
                                        <th>
                                            {{ __('Teléfono') }}
                                        </th>
                                        <th>
                                            {{ __('Email') }}
                                        </th>
                                        <th>
                                            {{ __('Fecha') }} {{$contactosEmpresasNuevas->count()}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($contactosEmpresasNuevas->total()>0) @foreach ($contactosEmpresasNuevas as $contacto)
                                    <tr id="{{$contacto->id}}">
                                        <td>

                                            {!! e($contacto->data['name']) !!}
                                        </td>
                                        <td>
                                            {{ e($contacto->data['phone']) }}
                                        </td>
                                        <td>
                                            {{ e($contacto->data['email']) }}
                                        </td>
                                        <td>
                                            {{ e($contacto->created_at->diffForHumans()) }}
                                        </td>

                                        <td class="text-right">
                                            @if ($contacto->unread())
                                            <i class="mdi mdi-star text-warning float-left"></i> @endif

                                            <div class="btn-group" role="group" aria-label="...">

                                                <a href="#" title="{{ __('Eliminar') }}" class="btn btn-sm btn-danger borrar_notificacion " data-id="{{$contacto->id}}">
                                                    <i class="fa fas fa-trash"></i>
                                                </a>

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
                                        <td colspan="3">{{ $contactosEmpresasNuevas->appends(request()->query())->links() }}</td>
                                        <td colspan="2" class="text-right">
                                            @if ($contactosEmpresasNuevas->total()>1)
                                            <small>
                                                <strong class="numTotal">
                                                    {{ $contactosEmpresasNuevas->total() }}
                                                </strong>
                                                @if ($contactosEmpresasNuevas->total()>1)
                                                {{ __(' solicitudes encontradas') }}
                                                @elseif($contactosEmpresasNuevas->total()==1)
                                                {{ __(' solicitud encontrada') }}
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
@endsection

@section('scripts')
<script>
    $('.borrar_notificacion').on('click', function (e) {
        var $boton = $(this);
        var $num = parseInt($boton.closest('table').find('.numTotal').html());
        console.log($num - 1);
        $.ajax({
            url: "{{ route('boorarNotificacion', ['id'=>" + $(this).data('id') + "]) }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "notificacion_id": $(this).data('id')
            },
            success: function (data) {
                if (data.status) {
                    $boton.closest('table').find('.numTotal').html($num - 1);
                    $boton.closest('tr').fadeOut(500);
                } else {
                    alert('Error');
                }
            }
        });
    });

</script>
@endsection
