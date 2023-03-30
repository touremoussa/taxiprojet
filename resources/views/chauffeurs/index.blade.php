@extends('layouts.app')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('chauffeurs.create') }}" class="btn btn-info">Create</a></div>

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
				<th>num_permis</th>
				<th>etat</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($chauffeurs as $chauffeur)

				<tr>
					<td>{{ $chauffeur->id }}</td>
					<td>{{ $chauffeur->nom }}</td>
					<td>{{ $chauffeur->prenom }}</td>
					<td>{{ $chauffeur->adresse }}</td>
					<td>{{ $chauffeur->email }}</td>
					<td>{{ $chauffeur->tel }}</td>
					<td>{{ $chauffeur->date_naissance }}</td>
					<td>{{ $chauffeur->num_permis }}</td>
					<td>{{ $chauffeur->etat }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('chauffeurs.show', [$chauffeur->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('chauffeurs.edit', [$chauffeur->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['chauffeurs.destroy', $chauffeur->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
