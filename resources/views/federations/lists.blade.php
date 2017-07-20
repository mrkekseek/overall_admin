@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>Federations List</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/">Dashboard</a>
        </li>
        <li class="active">Federations List</li>
    </ol>
</div>
@endsection

@section('content')
	@if (count($federations))
		<div class="table-scrollable">
		    <table class="table table-hover table-light">
		        <thead>
		            <tr>
		                <th>ID</th>
		                <th>Federation name</th>
		                <th>Contact person</th>
		                <th>Country</th>
		                <th>Sport</th>
		                <th class="text-center">Manage</th>
		                <th class="text-center">View</th>
		            </tr>
		        </thead>

		        <tbody>
		            @foreach ($federations as $federation)
		                <tr>
		                    <td>{{ $federation['id'] }}</td>
		                    <td>{{ $federation['name'] }}</td>
		                    <td>{{ $federation['owner']['first_name'] }} {{ $federation['owner']['last_name'] }}</td>
		                    <td>{{ $federation['address']['country'] }}</td>
		                    <td>{{ $federation['sport']['name'] }}</td>
		                    <td class="text-center">
		                        <a href="/federations/edit/{{ $federation['id'] }}" class="btn btn-icon"><i class="fa fa-edit"></i></a>
		                    </td>
		                    <td class="text-center">
                                <a href="/federations/details/{{ $federation['id'] }}" class="btn btn-icon"><i class="fa fa-eye"></i></a>
                            </td>
		                </tr>
		            @endforeach
		        </tbody>
		    </table>
		</div>
	@endif
@endsection
