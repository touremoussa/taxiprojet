@extends('layouts.app')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{{ Form::model($vehicule, array('route' => array('vehicules.update', $vehicule->id), 'method' => 'PUT')) }}

		<div class="mb-3">
			{{ Form::label('marque', 'Marque', ['class'=>'form-label']) }}
			{{ Form::text('marque', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('couleur', 'Couleur', ['class'=>'form-label']) }}
			{{ Form::text('couleur', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('places', 'Places', ['class'=>'form-label']) }}
			{{ Form::text('places', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}
@stop
