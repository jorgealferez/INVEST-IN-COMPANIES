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
                        <label for="provincia_id" class="col-md-12 col-form-label text-white text-uppercase text-left">{{ __('Provincia') }}</label>

                        <div class="col-md-12">
                            <select name="provincia_id" id="provincia_id" class="form-control ">
                                <option value="0">{{ __('Selecciona Perfil') }}</option>
                                @foreach ($provincias as $provincia)
                                <option value="{{ $provincia->id }}" @if ($request->input('provincia_id')== $provincia->id) selected @endif>{{ $provincia->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <button class="btn-invest d-inline-block bg-transparent text-uppercase fa-1x " type="submit">{{ __('Aplicar') }}</button>
            </div>
            </form>
        </div>


        <div class="col-md-9 pl-0">
            <table class="table table-striped table-hover">
                <thead class="thead-primary">
                    <tr>
                        <th scope="col">@sortablelink('sector', __('Sector'))</th>
                        <th scope="col">@sortablelink('name', __('Nombre'))</th>
                        <th scope="col">@sortablelink('valoracion', __('Valoracion'))</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ofertas as $oferta)
                    <tr>
                        <td>{{ e($oferta->sector['name']) }}</td>
                        <td>{{ e($oferta->name) }}</td>
                        <td>{{ e($oferta->valoracion) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">
                            @if ($ofertas->count()>0)
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
                            @else
                            <small>{{ __('No hay ofertas con esos criterios.') }}</small>
                            @endif
                        </td>
                        <td colspan="2" class="text-right">
                            <span class="d-inline-block float-right">
                                {{ $ofertas->appends(
                                    Request::except('page'))
                                    ->links() }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                    </tr>
                </tfoot>
            </table>


        </div>
    </div>

</div>


@endsection

@section('scripts')

@endsection
