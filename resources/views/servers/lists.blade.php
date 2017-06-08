@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>Servers List</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/dashboard">Dashboard</a>
        </li>
        <li class="active">Servers List</li>
    </ol>
</div>
@endsection

@section('content')
    @if (count($servers))
        <div class="table-scrollable">
            <table class="table table-hover table-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Server IP</th>
                        <th>Description</th>
                        <th class="text-center">Manage</th>
                        <th class="text-center">View</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($servers as $server)
                        <tr>
                            <td>{{ $server['id'] }}</td>
                            <td>{{ $server['ip_address'] }}</td>
                            <td>{{ $server['description'] }}</td>
                            <td class="text-center">
                                <a href="/servers/add/{{ $server['id'] }}" class="btn btn-icon"><i class="fa fa-edit"></i></a>
                            </td>
                            <td class="text-center">
                                <a href="/servers/details/{{ $server['id'] }}" class="btn btn btn-icon"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection