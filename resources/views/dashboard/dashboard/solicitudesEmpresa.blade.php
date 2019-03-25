<form method="POST" class="" action="{{ e(route('dashboardAsociaciones')) }}" id="formBorrarSolicitudEmpresa">
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
						{{ __('Contacto') }}
					</th>
					<th>
						{{ __('Fecha') }}
					</th>
				</tr>
			</thead>
			<tbody>
				@if($elementos->count()>0) @foreach ($elementos as $contacto)
				<tr id="{{$contacto->id}}">
					<td>

						{!! e($contacto->data['name']) !!}
					</td>
					<td>
						@if ($contacto->data['phone']) {{ e($contacto->data['phone']) }}<br> @endif @if ($contacto->data['email']) {{ e($contacto->data['email'])
						}}
						<br> @endif
					</td>
					<td>
						{{ e($contacto->created_at->diffForHumans()) }}
					</td>

					<td class="text-right">
						{{-- @if ($contacto->unread())
						<i class="mdi mdi-star text-warning float-left"></i> @endif --}}

						<div class="btn-group" role="group" aria-label="...">

							<a href="#" title="{{ __('Eliminar') }}" class="btn btn-sm btn-danger borrar_notificacion " data-id="{{$contacto->id}}">
                                                    <i class="fa fas fa-trash"></i>
                                                </a>

						</div>
					</td>
				</tr>
				@endforeach @else
				<tr>
					<td colspan="4">
						<p>{{ __('No hay resultados disponibles') }}</p>
					</td>
				</tr>
				@endif
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2">{{ $elementos->links() }}</td>
					<td colspan="2" class="text-right">
						@if ($elementos->count()>1)
						<small>
                                                <strong class="numTotal">
                                                    {{ $elementos->count() }}
                                                </strong>
                                                @if ($elementos->count()>1)
                                                {{ __(' solicitudes ') }}
                                                @elseif($elementos->count()==1)
                                                {{ __(' solicitud ') }}
                                                @endif
                                            </small> @endif
					</td>
				</tr>
			</tfoot>
		</table>
	</div>

</form>