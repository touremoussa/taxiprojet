@extends('layouts.app')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{{ Form::model($evaluation, array('route' => array('evaluations.update', $evaluation->id), 'method' => 'PUT')) }}

		<div class="mb-3">
			{{ Form::label('reservation_id', 'Reservation_id', ['class'=>'form-label']) }}
			{{ Form::text('reservation_id', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('note', 'Note', ['class'=>'form-label']) }}
			{{ Form::text('note', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('commentaire', 'Commentaire', ['class'=>'form-label']) }}
			{{ Form::textarea('commentaire', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}
@stop
