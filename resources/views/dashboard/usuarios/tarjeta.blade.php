<div class="col-lg-4 col-xlg-3 col-md-5">

    <div class="card card-profile">

        <div class="card-body text-center  bg-gray" style="max-height: 120px;">
            <span class="round {{ $usuario->getRoleClass() }} roleBig profile-rol ">
                        @switch($usuario->roles->first()->name)
                        @case("Admin")
                        @case("Gestor")
                        @case("Asesor")
                        @if (!$usuario->active)
                        <i class="mdi mdi-account-off" style="font-size: 570%;"></i>
                        @else
                        <i class="mdi mdi-account" style="font-size: 570%;"></i>
                        @endif
                        @break
                        @case("Inversor")
                        @default
                        <i class="mdi mdi-chart-line" style="font-size: 570%;"></i>
                        @break

                        @endswitch
                    </span>
        </div>

        <div class="card-body pro-img text-center pt-5">
            <h4 class="card-title m-t-10">{{ e($usuario->fullName) }}</h4>
            @if (!$usuario->active)
            <span class="badge badge-danger"> {{ __('Usuario Eliminado') }}</span> @endif
        </div>

        <hr class="m-0">

        <div class="card-body ">
            <small class="text-muted"><i class="ti-email"></i> {{ __('Email') }}</small>
            <a href="mailto:{{ e($usuario->email) }}" class="link text-muted">
                <h6>{{ e($usuario->email) }}</h6>
            </a>

            <small class="text-muted"><i class="ti-mobile"></i> {{ __('Teléfono') }}</small>
            <h6>{{ e($usuario->phone) }}</h6>

            <small class="text-muted"><i class="mdi mdi-security-home"></i> {{ __('Asociaciones') }}</small><br> @if ($usuario->asociaciones)
            @foreach ($usuario->asociaciones as $asociacion)
            <span class="badge badge-primary">{{ e($asociacion->name)}}</span> @endforeach @endif

        </div>
    </div>
</div>
