@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>Users</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/">Dashboard</a>
        </li>
        <li class="active">Users</li>
    </ol>
</div>
@endsection

@section('content')
    @if (count($users))
        <div class="table-scrollable">
            <table class="table table-hover table-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Country</th>
                        <th class="text-center">Manage</th>
                        <th class="text-center">View</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user['id'] }}</td>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['email'] }}</td>
                            <td>{{ $user['roles']->first()['display_name'] or '' }}</td>
                            <td>{{ $user['country'] }}</td>
                            <td class="text-center">
                                <a href="/settings/add/{{ $user['id'] }}" class="btn btn-icon"><i class="fa fa-edit"></i></a>
                            </td>
                            <td class="text-center">
                                <a href="/settings/details/{{ $user['id'] }}" class="btn btn-icon"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
