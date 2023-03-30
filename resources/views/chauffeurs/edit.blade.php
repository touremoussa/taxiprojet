@extends('layouts.app')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{{ Form::model($chauffeur, array('route' => array('chauffeurs.update', $chauffeur->id), 'method' => 'PUT')) }}

		<div class="mb-3">
			{{ Form::label('nom', 'Nom', ['class'=>'form-label']) }}
			{{ Form::text('nom', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('prenom', 'Prenom', ['class'=>'form-label']) }}
			{{ Form::text('prenom', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('adresse', 'Adresse', ['class'=>'form-label']) }}
			{{ Form::text('adresse', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('email', 'Email', ['class'=>'form-label']) }}
			{{ Form::text('email', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('tel', 'Tel', ['class'=>'form-label']) }}
			{{ Form::text('tel', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('date_naissance', 'Date_naissance', ['class'=>'form-label']) }}
			{{ Form::string('date_naissance', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('num_permis', 'Num_permis', ['class'=>'form-label']) }}
			{{ Form::text('num_permis', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('etat', 'Etat', ['class'=>'form-label']) }}
			{{ Form::text('etat', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}
@stop
