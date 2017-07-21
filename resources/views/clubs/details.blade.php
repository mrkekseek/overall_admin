@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>{{ $club->name }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="/">Dashboard</a>
        </li>
        <li>
            <a href="/clubs/lists">Clubs List</a>
        </li>
        <li class="active">{{ $club->name }}</li>
    </ol>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <h5> Your account key : <strong>{{ $club->account_key }}</strong></h5>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="portlet light bordered">
            <div class="portlet-body form">
                <h3>Basic Information</h3><br>

                @if( ! empty($club->owners->first_name) && ! empty($club->owners->last_name))
                    <h4><strong>Club owner</strong></h4>
                    <p>{{ $club->owners->first_name }} {{ $club->owners->last_name }}</p>
                @endif

               
                 @if( ! empty($club->owners->middle_name))
                    <h4><strong>Middle name</strong></h4>
                    <p>{{ $club->owners->middle_name }}</p>
                @endif

                @if( ! empty($club->owners->date_of_birth))
                    <h4><strong>Date of birth</strong></h4>
                    <p>{{ $club->owners->date_of_birth }}</p>
                @endif

                @if( ! empty($club->owners->phone_number))
                    <h4><strong>Phone number</strong></h4>
                    <p>{{ $club->owners->phone_number }}</p>
                @endif

                @if( ! empty($club->owners->email_address))
                    <h4><strong>Email address</strong></h4>
                    <p>{{ $club->owners->email_address }}</p>
                @endif
                @if( ! empty($club->details))
                    <h4><strong>Basic club details</strong></h4>
                    <p>{{ $club->details }}</p>
                @endif
                
                @if( ! empty($club->sport->name))
                    <h4><strong>Sport</strong></h4>
                    <p>{{ $club->sport->name }}</p>
                @endif

            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="portlet light bordered">
            <div class="portlet-body form">
                <h3>Home club address</h3><br>
                
                @if( ! empty($club->address_id))
                <div class="row">
                    <div class="col-md-6">

                        @if( ! empty($club->address->address1))
                        <h4><strong>Address 1</strong></h4>
                        <p>{{ $club->address->address1 }} </p>
                        @endif

                    </div>
                    <div class="col-md-6">

                        @if( ! empty($club->address->address2))
                        <h4><strong>Address 2</strong></h4>
                        <p>{{ $club->address->address2 }} </p>
                        @endif

                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">

                        @if( ! empty($club->address->city))
                        <h4><strong>City</strong></h4>
                        <p>{{ $club->address->city }} </p>
                        @endif

                    </div>
                    <div class="col-md-6">

                        @if( ! empty($club->address->region))
                        <h4><strong>Region</strong></h4>
                        <p>{{ $club->address->region }} </p>
                        @endif

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">

                        @if( ! empty($club->address->zipcode))
                        <h4><strong>Zip Code</strong></h4>
                        <p>{{ $club->address->zipcode }} </p>
                        @endif

                    </div>
                    <div class="col-md-6">

                        @if( ! empty($club->address->country ))
                        <h4><strong>Country</strong></h4>
                        <p>{{ $club->address->country }} </p>
                        @endif

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        @if( ! empty($club->address->details ))
                        <h4><strong>Details</strong></h4>
                        <p>{{ $club->address->details }} </p>
                        @endif

                    </div>
                </div>
                @else 
                <div class="row">
                    <div class="col-md-12">
                        <p>There is no address for this club</p>
                    </div>
                </div>
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
                    <table class="table table-hover table-light table-advance">
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
