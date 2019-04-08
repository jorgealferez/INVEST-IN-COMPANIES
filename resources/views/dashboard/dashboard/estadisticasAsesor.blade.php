<!-- Column -->
<div class="col-12 col-sm-6 col-md-6 col-lg-3 ">
	<div class="card">
		<div class="card-body">
			<div class="d-flex flex-row dashboar-dflex">
				<div class="round round-lg align-self-center round-warning"><i class="mdi mdi-tag-text-outline"></i></div>
				<div class="m-l-10 align-self-center">
					<h3 class="m-b-0 font-lgiht">{{ $numOfertas }}</h3>
					<h5 class="text-muted m-b-0">{{ __('Ofertas') }}</h5>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Column -->
<div class="col-12 col-sm-6 col-md-6 col-lg-3 ">
	<div class="card">
		<div class="card-body">
			<div class="d-flex flex-row dashboar-dflex">
				<div class="round round-lg align-self-center round-success"><i class="mdi mdi-tag-outline"></i></div>
				<div class="m-l-10 align-self-center">
					<h3 class="m-b-0 font-light">{{ $ofertasaprobadas }} ofertas</h3>
					<h5 class="text-muted m-b-0">{{ __('Aprobadas') }}</h5>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Column -->
<div class="col-12 col-sm-6 col-md-6 col-lg-3 ">
	<div class="card">
		<div class="card-body">
			<div class="d-flex flex-row dashboar-dflex">
				<div class="round round-lg align-self-center round-danger "><i class="mdi mdi-chart-line"></i></div>
				<div class="m-l-10 align-self-center">
					<h3 class="m-b-0 font-light">{{ $numInversiones }}</h3>
					<h5 class="text-muted m-b-0">{{ __('Inversiones') }}</h5>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Column -->
<div class="col-12 col-sm-6 col-md-6 col-lg-3 ">
	<div class="card">
		<div class="card-body">
			<div class="d-flex flex-row dashboar-dflex">
				<div class="round round-lg align-self-center roleAs "><i class="fas fa-user"></i></div>
				<div class="m-l-10 align-self-center">
					<h3 class="m-b-0 font-light">{{ $numUsuarios }} {{ __('usuarios')}}</h3>
					<h5 class="text-muted m-b-0">{{ __('en la Entidad') }}</h5>
				</div>
			</div>
		</div>
	</div>
</div>