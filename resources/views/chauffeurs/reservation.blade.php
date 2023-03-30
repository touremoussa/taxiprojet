@extends('layouts.app')

@section('content')
<?php
use App\Models\Chauffeur;
use Illuminate\Support\Facades\Auth;

$chauffeur = Chauffeur::where('email', Auth::user()->email)->first();
?>
<div class="container">
    <div class="row justify-content-center">
    <div class="text text-center" style="font-size: Large;" > ! Mes Reservations. </div> 
        <div class="col-md-14">
            @foreach($reservations as $reservation)
            <div class="row align-items-center">
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
								<a href="{{ route('chauffeur.prendre_reservation', [$reservation->id,Auth::user()->id]) }}" class="btn btn-outline-success">Engager</a>
						</div>
                </div>  
                @endif
                @if($reservation->etat == "C" && $reservation->chauffeur_id == $chauffeur->id)
                <div class="card mb-3">
                        <div class="card-header">Reservation en Cours</div>
                        <div class="card-body">
                            <h5 class="card-title"> Depart:  {{ $reservation->adresse_depart }}</h5>
                            <h5 class="card-title"> Arrivée: {{ $reservation->adresse_arrivee }}</h5>
							<h6 class="card-subtitle mb-2 text-muted">Duree estimée: {{ $reservation->dure }} minutes</h6>
							<h6 class="card-subtitle mb-2 text-muted">Trajet: {{ $reservation->distance }} Km</h6>
							<h6 class="card-subtitle mb-2 text-muted">Prix: {{ $reservation->prix }} </h6>
                        </div>
                        <div class="d-flex gap-2 mb-3">
								<a href="{{ route('chauffeur.fin_reservation', [$reservation->id]) }}" class="btn btn-outline-success">Finir</a>
						</div>
                </div>    
                @endif  
                @if($reservation->etat == "T" && $reservation->chauffeur_id == $chauffeur->id)
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
            @endforeach
        </div>
    </div>
</div>


@endsection