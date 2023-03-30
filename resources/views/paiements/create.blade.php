@extends('layouts.app')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{!! Form::open(['route' => 'paiements.store']) !!}

		<div class="mb-3">
			{{ Form::label('reservation_id', 'Reservation_id', ['class'=>'form-label']) }}
			{{ Form::text('reservation_id', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('montant', 'Montant', ['class'=>'form-label']) }}
			{{ Form::string('montant', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('mode', 'Mode', ['class'=>'form-label']) }}
			{{ Form::text('mode', null, array('class' => 'form-control')) }}
		</div>


		{{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}


@stop