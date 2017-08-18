@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>Representatives list</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/">Dashboard</a>
        </li>
        <li class="active">Representatives list</li>
    </ol>
</div>
@endsection

@section('content')
    @if (count($representatives))
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
                    @foreach ($representatives as $representative)
                        <tr>
                            <td>{{ $representative['id'] }}</td>
                            <td>
                                <a href="/representative/details/{{ $representative['id'] }}">{{ $representative['last_name'] }} {{ $representative['last_name'] }} {{ $representative['middle_name'] }}
                                </a>
                            </td>
                            <td>{{ $representative['date_of_birth'] }}</td>
                            <td>{{ $representative['email_address'] }}</td>
                            <td>{{ $representative['phone_number'] }}</td>
                            <td>{{ $representative->country_code->full_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection