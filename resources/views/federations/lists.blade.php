@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>Federations List</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/dashboard">Dashboard</a>
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
		                <th> Federation name </th>
		                <th class="text-center"> Contact person </th>
		                <th class="text-center"> Country </th>
		                <th class="text-center"> Date of registered </th>
		                <th class="text-center"> Manage </th>
		                <th class="text-center">Details</th>
		            </tr>
		        </thead>

		        <tbody>
		            @foreach ($federations as $federation)
		                <tr>
		                    <td>{{ $federation['id'] }}</td>
		                    <td>{{ $federation['name'] }}</td>
		                    <td class="text-center">{{ $federation['owner_id'] }}</td>
		                    <td class="text-center">{{ $federation['country'] }}</td>
		                    <td class="text-center">{{ $federation['created_at'] }}</td>
		                    <td class="text-center">
		                        <a href="/federations/add/{{ $federation['id'] }}" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Edit </a>
		                    </td>
		                    <td class="text-center">
                                <a href="/federations/details/{{ $federation['id'] }}" class="btn btn-outline btn-circle btn-sm blue"><i class="fa fa-info"></i> Details </a>
                            </td>
		                </tr>
		            @endforeach
		        </tbody>
		    </table>
		</div>
	@endif
@endsection
