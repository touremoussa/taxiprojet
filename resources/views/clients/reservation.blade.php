@extends('layouts.app')

@section('content')
<?php
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

$client = Client::where('email', Auth::user()->email)->first();
?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<div class="container">
    <div class="row justify-content-center">
    <div class="text text-center" style="font-size: Large;" > ! Mes Reservations. </div> 
        <div class="col-md-14">
            @foreach($reservations as $reservation)
            @if($reservation->client_id == $client->id)
            <div class="row align-items-center">
                @if($reservation->etat == "C")
                <div class="card mb-3">
                        <div class="card-header">Reservation en Cours</div>
                        <div class="card-body">
                            <h5 class="card-title"> Depart:  {{ $reservation->adresse_depart }}</h5>
                            <h5 class="card-title"> Arrivée: {{ $reservation->adresse_arrivee }}</h5>
							<h6 class="card-subtitle mb-2 text-muted">Duree estimée: {{ $reservation->dure }} minutes</h6>
							<h6 class="card-subtitle mb-2 text-muted">Trajet: {{ $reservation->distance }} Km</h6>
							<h6 class="card-subtitle mb-2 text-muted">Prix: {{ $reservation->prix }} </h6>
                        </div>
                </div>    
                @endif
                @if($reservation->etat == "A")
                <div class="card mb-3">
                        <div class="card-header">Reservation en Attente</div>
                        <div class="card-body">
                            <h5 class="card-title"> Depart:  {{ $reservation->adresse_depart }}</h5>
                            <h5 class="card-title"> Arrivée: {{ $reservation->adresse_arrivee }}</h5>
							<h6 class="card-subtitle mb-2 text-muted">Duree estimée: {{ $reservation->dure }} minutes</h6>
							<h6 class="card-subtitle mb-2 text-muted">Trajet: {{ $reservation->distance }} Km</h6>
							<h6 class="card-subtitle mb-2 text-muted">Prix: {{ $reservation->prix }} </h6>
                        </div>
                        <div class="d-flex gap-2 mb-3">
								<a href="{{ route('reservations.destroy', [$reservation->id]) }}" class="btn btn-outline-danger">Annuler</a>
						</div>
                </div>    
                @endif
                @if($reservation->etat == "T")
                <div class="card mb-3">
                        <div class="card-header">Reservation en Terminée</div>
                        <div class="card-body">
                            <h5 class="card-title"> Depart:  {{ $reservation->adresse_depart }}</h5>
                            <h5 class="card-title"> Arrivée: {{ $reservation->adresse_arrivee }}</h5>
							<h6 class="card-subtitle mb-2 text-muted">Duree estimée: {{ $reservation->dure }} minutes</h6>
							<h6 class="card-subtitle mb-2 text-muted">Trajet: {{ $reservation->distance }} Km</h6>
							<h6 class="card-subtitle mb-2 text-muted">Prix: {{ $reservation->prix }} </h6>
                        </div>
                       
                </div>
                @endif
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>

@endsection