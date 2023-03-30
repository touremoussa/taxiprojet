@extends('layouts.app')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('evaluations.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>reservation_id</th>
				<th>note</th>
				<th>commentaire</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($evaluations as $evaluation)

				<tr>
					<td>{{ $evaluation->id }}</td>
					<td>{{ $evaluation->reservation_id }}</td>
					<td>{{ $evaluation->note }}</td>
					<td>{{ $evaluation->commentaire }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('evaluations.show', [$evaluation->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('evaluations.edit', [$evaluation->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['evaluations.destroy', $evaluation->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
