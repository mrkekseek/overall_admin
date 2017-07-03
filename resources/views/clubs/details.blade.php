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
                
                @if( ! empty($club->details))
                <h4><strong>Basic club details</strong></h4>
                <p>{{ $club->details }}</p>
                @endif
                
                @if( ! empty($club->sport->name))
                <h4><strong>Sport</strong></h4>
                <p>{{ $club->sport->name }}</p>
                @endif
                
                @if( ! empty($club->subdomains->subdomain_link))
                <h4><strong> Club Subdomain</strong></h4>
                <p>{{ $club->subdomains->subdomain_link }}</p>
                @endif

            </div>
        </div>

        <div class="portlet light bordered">
            <div class="portlet-body form">
                <h3>Club Subdomain</h3><br>
                
                @if( ! empty($club->subdomains->subdomain_link))
                <h4><strong> Subdomain</strong></h4>
                <p>{{ $club->subdomains->subdomain_link }}</p>
                @endif

            </div>
        </div>

    </div>

    <div class="col-sm-6">
        <div class="portlet light bordered">
            <div class="portlet-body form">
            <h3>Home club address</h3><br>

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
                
            </div>
        </div>
    </div>
</div>

@endsection
