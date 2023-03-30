@extends('layouts.app')

@section('content')

    <div class="container">
    <div class="row justify-content-center">
    <div class="text text-center" style="font-size: Large;" > ! Le Confort dans le transport. </div> 
        <div class="col-md-14">
        <div class="row align-items-center">
                    
            <div class="card">
                <div class="card-header">Prendre une course</div>

                <div class="card-body">
                    <form id="reservation-form" method="POST" action="{{ route('reservations.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="adresse_depart" class="col-md-4 col-form-label text-md-end">Point de Depart</label>
                            
							<div class="col-md-6">
                                <input id="adresse_depart" type="text" class="form-control @error('adresse_depart') is-invalid @enderror" name="adresse_depart" value="{{ old('adresse_depart') }}" required autocomplete="adresse_depart">

                                @error('adresse_depart')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="adresse_arrivee" class="col-md-4 col-form-label text-md-end">Point Arrivee</label>

                            <div class="col-md-6">
                                <input id="adresse_arrivee" type="text" class="form-control @error('adresse_arrivee') is-invalid @enderror" name="adresse_arrivee" value="{{ old('adresse_arrivee') }}" required autocomplete="adresse_arrivee">

                                @error('adresse_arrivee')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="dure" class="col-md-4 col-form-label text-md-end">Duree du trajet (min)</label>

                            <div class="col-md-6">
                                <input id="dure" type="number" class="form-control @error('dure') is-invalid @enderror" name="dure" value="{{ old('dure') }}" required autocomplete="dure">

                                @error('dure')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

						<div class="row mb-3">
                            <label for="prix" class="col-md-4 col-form-label text-md-end">Prix</label>

                            <div class="col-md-6">
                                <input id="Prix" type="number" class="form-control @error('prix') is-invalid @enderror" name="prix" value="{{ old('prix') }}" required autocomplete="prix">

                                @error('prix')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Valider
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([48.864716, 2.349014], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',
        maxZoom: 18,
    }).addTo(map);

    var startMarker = L.marker([48.864716, 2.349014]).addTo(map);
    var endMarker = L.marker([48.874237, 2.321748]).addTo(map);
    startMarker.on('click', function(e) {
        document.getElementById('start-address').value = e.latlng.lat + ', ' + e.latlng.lng;
    });

    endMarker.on('click', function(e) {
        document.getElementById('end-address').value = e.latlng.lat + ', ' + e.latlng.lng;
    });

    var distanceInput = document.getElementById('distance');
    var priceInput = document.getElementById('price');

    map.on('click', function(e) {
        L.DomEvent.stopPropagation(e);
    });

    map.on('mousemove', function(e) {
        if (startMarker.dragging._draggable._enabled) {
            var distance = startMarker.getLatLng().distanceTo(endMarker.getLatLng()) / 1000;
            distanceInput.value = distance.toFixed(2);
            priceInput.value = (distance * 1.5).toFixed(2);
        }
    });

    var reservationForm = document.getElementById('reservation-form');
    reservationForm.addEventListener('submit', function(e) {
        e.preventDefault();
        var startAddress = document.getElementById('start-address').value;
        var endAddress = document.getElementById('end-address').value;
        var distance = distanceInput.value;
        var price = priceInput.value;
        // Envoi de la réservation à votre application Laravel via une requête AJAX
    });
</script>

@endsection
