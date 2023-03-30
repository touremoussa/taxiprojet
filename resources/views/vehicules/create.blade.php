@extends('layouts.app')

@section('content')
<style>

    .presentation-img img{
        
        width: 100%;
        max-width: 400px;
        margin:auto;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
    <div class="text text-center" style="font-size: Large;" > ! Le Plaisir de Conduire. </div> 

        <div class="col-md-14">
        <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="presentation-img">
                        <img src="https://img.freepik.com/vecteurs-premium/illustration-vectorielle-concept-abstrait-serveur-proxy_107173-28165.jpg?size=626&ext=jpg&ga=GA1.1.938414909.1676740287&semt=sph" alt="Image de programmation">
                        </div>
                    </div>
                    <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('vehicules.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="marque" class="col-md-4 col-form-label text-md-end">Marque</label>

                            <div class="col-md-6">
                                <select id="mq" class="form-select @error('marque') is-invalid @enderror" name="marque" required>
                                    <option value="">Choisir...</option>
                                    <option value="Toyota" {{ old('marque') == 'Toyota' ? 'selected' : '' }}>Toyota</option>
                                    <option value="Renault" {{ old('marque') == 'Renault' ? 'selected' : '' }}>Renault</option>
                                    <option value="Citroen" {{ old('marque') == 'Citroen' ? 'selected' : '' }}>Citroen</option>
                                    <option value="Ford" {{ old('marque') == 'Ford' ? 'selected' : '' }}>Ford</option>
                                    <option value="Peugeot" {{ old('marque') == 'Peugeot' ? 'selected' : '' }}>Peugeot</option>
                                </select>

								@error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="couleur" class="col-md-4 col-form-label text-md-end">Couleur</label>

                            <div class="col-md-6">
                                <select id="couleur" class="form-select @error('couleur') is-invalid @enderror" name="couleur" required>
                                    <option value="">Choisir...</option>
                                    <option value="Noire" {{ old('couleur') == 'Noire' ? 'selected' : '' }}>Noire</option>
                                    <option value="Blanche" {{ old('couleur') == 'Blanche' ? 'selected' : '' }}>Blanche</option>
                                    <option value="Bleue" {{ old('couleur') == 'Bleue' ? 'selected' : '' }}>Bleue</option>
                                    <option value="Jaune" {{ old('couleur') == 'Jaune' ? 'selected' : '' }}>Jaune</option>
                                    <option value="Rouge" {{ old('couleur') == 'Rouge' ? 'selected' : '' }}>Rouge</option>
                                </select>

                                @error('prenom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

						<div class="row mb-3">
                            <label for="places" class="col-md-4 col-form-label text-md-end">Nombre de Places</label>

                            <div class="col-md-6">
                                <input id="nb_p" type="number" class="form-control @error('nombre_place') is-invalid @enderror" name="nombre_place" value="{{ old('nombre_place') }}" required autocomplete="nombre_place">

                                @error('nombre_place')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Repertorier
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
</div>
@endsection
