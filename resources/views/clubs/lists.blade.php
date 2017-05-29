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
                        <th> Club name </th>
                        <th class="text-center">Owner</th>
                        <th class="text-center">Details</th>
                        <th class="text-center">Date of registered</th>
                        <th class="text-center">Manage</th>
                        <th class="text-center">Details</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($clubs as $club)
                        <tr>
                            <td>{{ $club['id'] }}</td>
                            <td class="text-center">{!! $club['signupFlag'] ? '<i class="fa fa-star font-yellow-crusta"></i>' : '' !!}</td>
                            <td>{{ $club['name'] }}</td>
                            <td class="text-center">{{ $club['owner_id'] }}</td>
                            <td class="text-center">{{ $club['details'] }}</td>
                            <td class="text-center">{{ $club['created_at'] }}</td>
                            <td class="text-center">
                                <a href="/clubs/add/{{ $club['id'] }}" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Edit </a>
                            </td>
                            <td class="text-center">
                                <a href="/clubs/details/{{ $club['id'] }}" class="btn btn-outline btn-circle btn-sm blue"><i class="fa fa-info"></i> Details </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection