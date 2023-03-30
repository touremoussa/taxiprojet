@extends('layouts.app')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('clients.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>nom</th>
				<th>prenom</th>
				<th>adresse</th>
				<th>email</th>
				<th>tel</th>
				<th>date_naissance</th>
				<th>num_compte</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($clients as $client)

				<tr>
					<td>{{ $client->id }}</td>
					<td>{{ $client->nom }}</td>
					<td>{{ $client->prenom }}</td>
					<td>{{ $client->adresse }}</td>
					<td>{{ $client->email }}</td>
					<td>{{ $client->tel }}</td>
					<td>{{ $client->date_naissance }}</td>
					<td>{{ $client->num_compte }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('clients.show', [$client->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('clients.edit', [$client->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['clients.destroy', $client->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
