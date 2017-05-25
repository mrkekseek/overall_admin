@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>List of all registered clubs with a sign for new registrations in the last 7 days</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/dashboard">Dashboard</a>
        </li>
        <li class="active">Club list</li>
    </ol>
</div>
@endsection

@section('content')

    <div class="table-scrollable">
        <table class="table table-hover table-light">
            <thead>
                <tr>
                    <th>ID</th>
                    <th> Club name </th>
                    <th class="text-center"> Owner </th>
                    <th class="text-center"> Details </th>
                    <th class="text-center"> Date of registered </th>
                    <th class="text-center"> Manage/Edit </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clubs as $club)
                    <tr>
                        <td>{{ $club['id'] }}</td>
                        <td>{{ $club['name'] }}</td>
                        <td class="text-center">{{ $club['owner_id'] }}</td>
                        <td class="text-center">{{ $club['details'] }}</td>
                        <td class="text-center">{{ $club['created_at'] }}</td>
                        <td class="text-center">
                            <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Edit </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
   @if (count($errors) > 0)
   <div class="row">
        <div class="col-sm-6">
    	    @foreach ($errors->all() as $error)
    	    <div class="alert alert-success alert-dismissable">
    	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <strong>Success!</strong> {{ $error }}
    	    </div>
    	    @endforeach
        </div>
    </div>
	@endif
@endsection