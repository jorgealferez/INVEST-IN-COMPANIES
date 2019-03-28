<div class="table-responsive">
	<table class="table stylish-table tabla-dashboard f">
		<thead>
			<tr>
				<th class="no-wrap" style="width: 50%">{{ __('Inversor') }}</th>
				<th class="text-center no-wrap" style="width: 30%">{{ __('Oferta') }}</th>
				<th class="no-wrap" style="width: 20%"></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($inversiones as $inversion)
			<tr>
				<td class=" text-truncate">
					<span class="badge estado-{{ $inversion->estado->id }} float-left text-white align-middle mr-2">
						{{ e( $inversion->estado->name) }}
					</span> {{ e( $inversion->usuario->FullName) }}
				</td>
				<td class="text-center">
					{{ e($inversion->oferta->name) }}
				</td>
				<td class="text-right">
					<a href="<?php echo urldecode(route('dashboardOferta',['oferta'=>$inversion->oferta])); ?>" data-toggle="tooltip" data-original-title="{{ __('Ver') }}"
					 class="btn btn-sm btn-secondary">{{ __('Ver') }}</a>

				</td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<td colspan="">{{ $inversiones->links() }}</td>
				<td colspan="2" class="text-right">
					@if ($inversiones->total()>1)
					<small>
                                                <strong class="numTotal">
                                                    {{ $inversiones->total() }}
                                                </strong>
                                                @if ($inversiones->total()>1)
                                                {{ __(' inversiones ') }}
                                                @elseif($inversiones->total()==1)
                                                {{ __(' inversión ') }}
                                                @endif
                                            </small> @endif
				</td>
			</tr>
		</tfoot>
	</table>
</div>