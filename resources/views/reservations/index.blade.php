@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
    <div class="text text-center" style="font-size: Large;" > Liste des Reservations. </div> 
		<div class="row align-items-center">
			@foreach($reservations as $reservation)
        	<div class="col-md-8">
                <div class="card  mb-3">
                        <div class="card-header">Numero: {{ $reservation->id }}</div>
                        <div class="card-body">
                            <h5 class="card-title"> Depart:  {{ $reservation->adresse_depart }}</h5>
							<h6 class="card-subtitle mb-2 text-muted">Latitude: {{ $reservation->d_latitude }} Longitude: {{ $reservation->d_longitude }}</h6>
                            <h5 class="card-title"> Arrivée: {{ $reservation->adresse_arrivee }}</h5>
							<h6 class="card-subtitle mb-2 text-muted">Latitude: {{ $reservation->a_latitude }} Longitude: {{ $reservation->a_longitude }}</h6>
							<h6 class="card-subtitle mb-2 text-muted">Duree estimée: {{ $reservation->dure }} minutes</h6>
							<h6 class="card-subtitle mb-2 text-muted">Trajet: {{ $reservation->distance }} Km</h6>
							<h6 class="card-subtitle mb-2 text-muted">Prix: {{ $reservation->prix }} </h6>
                        </div>
                </div>    
            </div>
			@endforeach
        </div>
    </div>
</div>


@endsection