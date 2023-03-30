@extends('layouts.app')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{{ Form::model($reservation, array('route' => array('reservations.update', $reservation->id), 'method' => 'PUT')) }}

		<div class="mb-3">
			{{ Form::label('client_id', 'Client_id', ['class'=>'form-label']) }}
			{{ Form::text('client_id', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('chauffeur_id', 'Chauffeur_id', ['class'=>'form-label']) }}
			{{ Form::text('chauffeur_id', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('dure', 'Dure', ['class'=>'form-label']) }}
			{{ Form::string('dure', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('adresse_depart', 'Adresse_depart', ['class'=>'form-label']) }}
			{{ Form::text('adresse_depart', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('adresse_arrivee', 'Adresse_arrivee', ['class'=>'form-label']) }}
			{{ Form::text('adresse_arrivee', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('d_longitude', 'D_longitude', ['class'=>'form-label']) }}
			{{ Form::string('d_longitude', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('d_latitude', 'D_latitude', ['class'=>'form-label']) }}
			{{ Form::string('d_latitude', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('a_longitude', 'A_longitude', ['class'=>'form-label']) }}
			{{ Form::string('a_longitude', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('a_latitude', 'A_latitude', ['class'=>'form-label']) }}
			{{ Form::string('a_latitude', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('prix', 'Prix', ['class'=>'form-label']) }}
			{{ Form::string('prix', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('etat', 'Etat', ['class'=>'form-label']) }}
			{{ Form::text('etat', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}
@stop
