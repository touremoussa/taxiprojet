@extends('layouts.app')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('paiements.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>reservation_id</th>
				<th>montant</th>
				<th>mode</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($paiements as $paiement)

				<tr>
					<td>{{ $paiement->id }}</td>
					<td>{{ $paiement->reservation_id }}</td>
					<td>{{ $paiement->montant }}</td>
					<td>{{ $paiement->mode }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('paiements.show', [$paiement->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('paiements.edit', [$paiement->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['paiements.destroy', $paiement->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
