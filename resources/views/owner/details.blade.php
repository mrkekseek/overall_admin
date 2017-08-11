@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>{{ $owner->first_name }} {{ $owner->last_name }} {{ $owner->middle_name }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="/">Dashboard</a>
        </li>
        <li>
            <a href="/clubs/lists">Clubs List</a>
        </li>
        <li class="active">{{ $owner->first_name }}</li>
    </ol>
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="portlet light bordered">
            <div class="portlet-body form">
                <h3>Basic Information</h3><br>

                @if( ! empty($owner->first_name) && ! empty($owner->last_name) && ! empty($owner->middle_name))
                    <h4><strong>Name</strong></h4>
                    <p>{{ $owner->first_name }} {{ $owner->last_name }} {{ $owner->middle_name }}</p>
                @endif
                
                @if( ! empty($owner->date_of_birth))
                    <h4><strong>Date of Birth</strong></h4>
                    <p>{{ $owner->date_of_birth }}</p>
                @endif

                @if( ! empty($owner->email_address))
                    <h4><strong>Email</strong></h4>
                    <p>{{ $owner->email_address }}</p>
                @endif

                 @if( ! empty($owner->phone_number))
                    <h4><strong>Phone</strong></h4>
                    <p>{{ $owner->phone_number }}</p>
                @endif

                @if( ! empty($owner->gender))
                    <h4><strong>Gender</strong></h4>
                    <p>{{ @['m' => 'Male', 'f' => 'Female'][$owner->gender] }}</p>
                @endif

                @if( ! empty($owner->country_code))
                    <h4><strong>Country</strong></h4>
                    <p>{{ $owner->country_code->full_name }}</p>
                @endif

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">

        @if( ! empty($club->subdomains))
        <div class="portlet light bordered">
            <div class="portlet-body form">
                <h3>Club Subdomain</h3><br>
                <h4><strong> Subdomain</strong></h4>
                <p>{{ $club->subdomains->subdomain_link }}</p>

                <h3>Club Locations</h3><br>
                
                @if( ! empty($message))
                    <div class="row">
                        <div class="col-md-6">
                        <div class="alert alert-danger alert-dismissable">
                            <span>The selected account key is invalid</span>
                        </div> 
                    </div>
                </div>
                @else 
                <div class="table-scrollable location-club">
                    <table class="table table-hover table-strited table-light">
                        <thead>
                            <tr>
                                <th class="text-uppercase">Name</th>
                                <th class="text-uppercase">Address</th>
                                <th class="text-uppercase">Place</th>
                                <th class="text-uppercase">Sport</th>
                            </tr>
                        </thead>

                        @foreach ($locations as $location)
                        <tr>
                            <td class="mt-action text-uppercase">{{ $location->name }}</td>
                            <td>{{ $location->full_address }}</td>
                            <td>@foreach ($location->resources as $resources)
                                    <span>{{ $resources->resource_name }}</span><br>
                                @endforeach
                            </td>
                            <td>@foreach ($location->resources as $resources)
                                    <span>{{ $resources->resource_type }}</span><br>
                                @endforeach
                            </td>
                        </tr>
                        @endforeach

                    </table>
                </div>
                @endif

            </div>
        </div>
        @endif

    </div>
</div>
@endsection
