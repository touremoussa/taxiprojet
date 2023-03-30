@extends('layouts.app')

@section('content')

<div id="map" style="height: 400px;"></div>

<div class="card">
                <div class="card-header">Prendre une course</div>

                <div class="card-body">
                    <form id="reservation-form" method="POST" action="{{ route('reservations.store') }}">
                        @csrf
                        @auth
                            <input type="text" hidden name="client_id" value="{{Auth::user()->id}}">
                        @endauth
                        <div class="row mb-3">
                            <label for="adresse_depart" class="col-md-4 col-form-label text-md-end">Point de Depart</label>
                            
							<div class="col-md-6">
                                <input id="adresse_depart" readonly type="text" class="form-control @error('adresse_depart') is-invalid @enderror" name="adresse_depart" value="{{ old('adresse_depart') }}" required autocomplete="adresse_depart">

                                @error('adresse_depart')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="">lat</label>
                            <input type="text" readonly id="d_lat" name="d_latitude">
                        </div>
                        <div class="row mb-3">
                            <label for="">long</label>
                            <input type="text" readonly id="d_long" name="d_longitude">
                        </div>

                        <div class="row mb-3">
                            <label for="adresse_arrivee" class="col-md-4 col-form-label text-md-end">Point Arrivee</label>

                            <div class="col-md-6">
                                <input id="adresse_arrivee" readonly type="text" class="form-control @error('adresse_arrivee') is-invalid @enderror" name="adresse_arrivee" value="{{ old('adresse_arrivee') }}" required autocomplete="adresse_arrivee">

                                @error('adresse_arrivee')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="">lat</label>
                            <input type="text" readonly id="a_lat" name="a_latitude">
                        </div>
                        <div class="row mb-3">
                            <label for="">long</label>
                            <input type="text" readonly id="a_long" name="a_longitude">
                        </div>

                        <div class="row mb-3">
                            <label for="dure" class="col-md-4 col-form-label text-md-end">Duree du trajet (min)</label>

                            <div class="col-md-6">
                                <input id="dure" type="datetime" readonly class="form-control @error('dure') is-invalid @enderror" name="dure" value="{{ old('dure') }}" required autocomplete="dure">

                                @error('dure')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="distance" class="col-md-4 col-form-label text-md-end">Distance du trajet (Km)</label>

                            <div class="col-md-6">
                                <input id="distance" readonly type="float" class="form-control @error('distance') is-invalid @enderror" name="distance" value="{{ old('distance') }}" required autocomplete="distance">

                                @error('distance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

						<div class="row mb-3">
                            <label for="prix" class="col-md-4 col-form-label text-md-end">Prix (FCFA)</label>

                            <div class="col-md-6">
                                <input id="prix" readonly type="number" class="form-control @error('prix') is-invalid @enderror" name="prix" value="{{ old('prix') }}" required autocomplete="prix">

                                @error('prix')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="paiement" class="col-md-4 col-form-label text-md-end">Mode Paiement</label>

                            <div class="col-md-6">
                                <select id="m_p" class="form-select @error('mode_paiement') is-invalid @enderror" name="mode_paiement" required>
                                    <option value="">Choisir...</option>
                                    <option value="Orange_Money" {{ old('mode_paiement') == 'Orange_Money' ? 'selected' : '' }}>Orange Money</option>
                                    <option value="Wave" {{ old('mode_paiement') == 'Wave' ? 'selected' : '' }}>Wave</option>
                                    <option value="Carte_Credit" {{ old('mode_paiement') == 'Carte_Credit' ? 'selected' : '' }}>Carte de Credit</option>
                                    <option value="Cash" {{ old('mode_paiement') == 'Cash' ? 'selected' : '' }}>Cash</option>
                                </select>
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

<!-- JavaScript -->
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([48.864716, 2.349014], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',
        maxZoom: 18,
    }).addTo(map);

    // Créer une icône personnalisée en vert
    var greenIcon = L.icon({
        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        tooltipAnchor: [16, -28],
        shadowSize: [41, 41]
    });
    var markerDepart = L.marker([0, 0], { draggable: true }).addTo(map);
    var markerArrivee = L.marker([0, 0], { draggable: true }).addTo(map);

    // Ajouter un événement de dragend pour les marqueurs de départ et d'arrivée
    markerDepart.setIcon(greenIcon);
    markerArrivee.setIcon(greenIcon);
    
    map.on('click', function(e) {
    // Récupérer la latitude et la longitude du clic
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        var url = "https://us1.locationiq.com/v1/reverse?key=pk.771956bda85a36f299d7d6d5acb881ac&lat=" + lat + "&lon=" + lng + "&format=json";

        // Définir la position du marqueur de départ et mettre à jour le formulaire
        markerDepart.setLatLng(e.latlng);
        $("#d_lat").val(lat);
        $("#d_long").val(lng);
        var settings_depart = {
            "async": true,
            "crossDomain": true,
            "url": url,
            "method": "GET"
            }

            $.ajax(settings_depart).done(function (response) {
            console.log(response);
            const addressParts = response.display_name.split(",");
            let result = "";

            if (addressParts.length > 3) {
            for (let i = 0; i < 3; i++) {
                result += addressParts[i] + ",";
            }
            }

            result = result.slice(0, -1); // retire la virgule finale

            $("#adresse_depart").val(result);
            });

                   
    });

        // Ajouter un événement de clic à la carte pour sélectionner l'adresse d'arrivée
    map.on('contextmenu', function(e) {
            // Récupérer la latitude et la longitude du clic
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        var url = "https://us1.locationiq.com/v1/reverse?key=pk.771956bda85a36f299d7d6d5acb881ac&lat=" + lat + "&lon=" + lng + "&format=json";

            // Définir la position du marqueur d'arrivée et mettre à jour le formulaire
        markerArrivee.setLatLng(e.latlng);
        $("#a_lat").val(lat);
        $("#a_long").val(lng);

        var settings_arrivee = {
            "async": true,
            "crossDomain": true,
            "url": url,
            "method": "GET"
            }

            $.ajax(settings_arrivee).done(function (response) {
            console.log(response);
            const addressParts = response.display_name.split(",");
            let result = "";

            if (addressParts.length > 2) {
            for (let i = 0; i < 2; i++) {
                result += addressParts[i] + ",";
            }
            }

            result = result.slice(0, -1); // retire la virgule finale

            $("#adresse_arrivee").val(result);
            });

            // Appeler la requête AJAX pour Distance Matrix API et afficher le résultat dans la console
            var d_lat = $('#d_lat').val();
            var d_lng = $('#d_long').val();
            var url2 = "https://us1.locationiq.com/v1/directions/driving/"+d_lng+","+d_lat+";"+lng+","+lat+"?key=pk.771956bda85a36f299d7d6d5acb881ac&steps=true&alternatives=true&geometries=polyline&overview=full"
            var settings_d_d = {
            "async": true,
            "crossDomain": true,
            "url": url2,
            "method": "GET"
            }
            console.log(d_lat);
                
            $.ajax(settings_d_d).done(function(response) {
                    console.log(response);
                    var distance = response.routes[0].distance / 1000
                    var duree = response.routes[0].duration /40
                    var prix = ((distance * 2 + duree * 0.1)*150).toFixed(0);
                    var price = adjustPrice(prix);
                    $("#dure").val(duree.toFixed(0));
                    $("#distance").val(distance.toFixed(1));
                    $("#prix").val(price);
                });
            
                function adjustPrice(price) {
                    if (price < 500) {
                        return 500;
                    } else if (price < 1900) {
                        return Math.round(price/100)*100;
                    } else if (price < 2000) {
                        return 1900;
                    } else {
                        return Math.round(price/1000)*1000;
                    }
                }
        });
                
    
</script>
@endsection
@endsection
