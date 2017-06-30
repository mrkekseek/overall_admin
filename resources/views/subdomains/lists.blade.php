@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>Subdomains List</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/">Dashboard</a>
        </li>
        <li class="active">Subdomains List</li>
    </ol>
</div>
@endsection

@section('content')
    @if (count($subdomains))
        <div class="table-scrollable">
            <table class="table table-hover table-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Subdomain Link</th>
                        <th class="text-center">Manage</th>
                        <th class="text-center">Details</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($subdomains as $subdomain)
                        <tr>
                            <td>{{ $subdomain['id'] }}</td>
                            <td>{{ $subdomain['subdomain_link'] }}</td>
                            <td class="text-center">
                                <a href="/subdomains/add/{{ $subdomain['id'] }}" class="btn btn-icon"><i class="fa fa-edit"></i></a>
                            </td>
                            <td class="text-center">
                                <a href="/subdomains/details/{{ $subdomain['id'] }}" class="btn btn-icon"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection