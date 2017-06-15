@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>Clubs list</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/dashboard">Dashboard</a>
        </li>
        <li class="active">Clubs list</li>
    </ol>
</div>
@endsection

@section('content')
    @if (count($clubs))
        <div class="table-scrollable">
            <table class="table table-hover table-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th class="text-center">New</th>
                        <th>Club name</th>
                        <th>Owner</th>
                        <th>Country</th>
                        <th>Sport</th>
                        <th class="text-center">Manage</th>
                        <th class="text-center">View</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($clubs as $club)
                        <tr>
                            <td>{{ $club['id'] }}</td>
                            <td class="text-center">{!! $club['signupFlag'] ? '<i class="fa fa-star font-yellow-crusta"></i>' : '' !!}</td>
                            <td>{{ $club['name'] }}</td>
                            <td>{{ $club['owner']['first_name'] }} {{ $club['owner']['last_name'] }}</td>
                            <td>{{ $club['address']['country'] }}</td>
                            <td>{{ $club['sport']['name'] }}</td>
                            <td class="text-center">
                                <a href="/clubs/add/{{ $club['id'] }}" class="btn btn-icon"><i class="fa fa-edit"></i></a>
                            </td>
                            <td class="text-center">
                                <a href="/clubs/details/{{ $club['id'] }}" class="btn btn-icon"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif



@endsection