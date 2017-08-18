@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>Owner list</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/">Dashboard</a>
        </li>
        <li class="active">Owner list</li>
    </ol>
</div>
@endsection

@section('content')
    @if (count($owners))
        <div class="table-scrollable">
            <table class="table table-hover table-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>Email</th>
                        <th>Phone number</th>
                        <th>Country</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($owners as $owner)
                        <tr>
                            <td>{{ $owner['id'] }}</td>
                            <td>
                                <a href="/owner/details/{{ $owner['id'] }}">{{ $owner['first_name'] }} {{ $owner['last_name'] }} {{ $owner['middle_name'] }}</a>
                            </td>
                            <td>{{ $owner['date_of_birth'] }}</td>
                            <td>{{ $owner['email_address'] }}</td>
                            <td>{{ $owner['phone_number'] }}</td>
                            <td>{{ $owner->country_code->full_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection