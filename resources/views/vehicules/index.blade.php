@extends('layouts.app')

@section('content')
<style>
	.icone img{
		width: 50%;
		max-width: 400px;
		margin:auto;
	}
</style>

<div class="row justify-content-center mb-4 " style="width: 100%;">
<div class="d-flex justify-content-end mb-3"><a href="{{ route('vehicules.create') }}" class="btn btn-info">Ajouter</a></div>
				@foreach ($vehicules as $vehicule)
					<div class="col-lg-4 col-md-6 mb-3">
						<div class="card" style="width: 100%;">
						<div class="icone">
						<img id="icone" src="https://img.freepik.com/icones-gratuites/ligne_318-717717.jpg?size=626&ext=jpg&ga=GA1.1.938414909.1676740287&semt=ais" class="card-img-top" alt="card-img-top">
						</div>
						<div class="card-body">
							<h5 class="card-title">Marque:  {{ $vehicule->marque }}</h5>
							<h6 class="card-subtitle mb-2 text-muted">Couleur: {{ $vehicule->couleur }} </h6>
							<h6 class="card-subtitle mb-2 text-muted">Places: {{ $vehicule->places }} </h6>
							<div class="d-flex gap-2">
								<a href="{{ route('vehicules.edit', [$vehicule->id]) }}" class="btn btn-outline-warning">Modifier</a>
								{!! Form::open(['method' => 'DELETE','route' => ['vehicules.destroy', $vehicule->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-outline-danger']) !!}
								{!! Form::close() !!}
							</div>
						</div>
						</div>
					</div>
				@endforeach
		
</div>

@stop
