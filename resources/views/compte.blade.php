@extends('layouts.app')

@section('content')
<style>
	 .presentation-img img{
        
        width: 40%;
        max-width: 400px;
        margin:auto;
    }
</style>
<div class="row justify-content-center mb-4 " style="width: 100%;">
				@if(Auth::check() && Auth::user()->type == 'client')
					<div class="col-lg-10 col-md-10">
						<div class="card" style="width: 100%;">
                        <div class="card-header"> Votre Compte Client </div>
                        <div class="card-body">
							<h5 class="card-title">  {{ $user0->prenom }}  {{ $user0->nom }}</h5>
							<h6 class="card-subtitle mb-2 text-muted">Telephone: {{ $user0->tel }} </h6>
							<h6 class="card-subtitle mb-2 text-muted">Email: {{ $user0->email }} </h6>
							<h6 class="card-subtitle mb-2 text-muted">No Carte Credit: {{ $user0->num_compte }} </h6>
							<h6 class="card-subtitle mb-2 text-muted">Date Naissance: {{ $user0->date_naissance }} </h6>
						</div>
						<div class="d-flex gap-2 mb-3">
								<a href="{{ route('compte.edit', [$user0->id,Auth::user()->type ]) }}" class="btn btn-outline-warning">Modifier mon Compte</a>
							</div>
						</div>
					</div>
				@endif
				@if(Auth::check() && Auth::user()->type == 'chauffeur')
					<div class="col-lg-4 col-md-6">
						<div class="card" style="width: 100%;">
                        <div class="card-header"> Votre Compte Chauffeur </div>
                        <div class="card-body">
							<h5 class="card-title">  {{ $user0->prenom }}  {{ $user0->nom }}</h5>
							<h6 class="card-subtitle mb-2 text-muted">Telephone: {{ $user0->tel }} </h6>
							<h6 class="card-subtitle mb-2 text-muted">Email: {{ $user0->email }} </h6>
							<h6 class="card-subtitle mb-2 text-muted">No Permis: {{ $user0->num_permis }} </h6>
							<h6 class="card-subtitle mb-2 text-muted">Date Naissance: {{ $user0->date_naissance }} </h6>
						</div>
						<div class="d-flex gap-2">
								<a href="{{ route('compte.edit', [$user0->id, Auth::user()->type]) }}" class="btn btn-outline-warning">Modifier mon Compte</a>
							</div>
						</div>
						</div>
					</div>
				@endif
				@if(Auth::check() && Auth::user()->type == 'admin')
					<div class="col-lg-4 col-md-6">
						<div class="card" style="width: 100%;">
                        <div class="card-header"> Votre Compte Administrateur </div>
						<div class="card-body">
							<h5 class="card-title">    {{ $user->name }}</h5>
							<h6 class="card-subtitle mb-2 text-muted">Email: {{ $user->email }} </h6>
							</div>
						</div>
					</div>
				@endif
		
</div>

@stop
