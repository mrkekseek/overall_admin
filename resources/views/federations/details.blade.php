@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>{{ $federation->name }}</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/">Dashboard</a>
        </li>
        <li>
            <a href="/clubs/lists">Federations List</a>
        </li>
        <li class="active">{{ $federation->name }}</li>
    </ol>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <h5> Your account key : <strong>{{ $federation->account_key }}</strong></h5>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="portlet light bordered">
            <div class="portlet-body form">
                <h3>Basic Information</h3><br>

                @if( ! empty($federation->name))
                <h4><strong>Federation name</strong></h4>
                <p>{{ $federation->name }}</p>
                @endif
                
                @if( ! empty($federation->owners->first_name) && ! empty($federation->owners->last_name))
                <h4><strong>Federation Contact Person</strong></h4>
                <p>{{ $federation->owners->first_name }} {{ $federation->owners->last_name }}</p>
                @endif

                @if( ! empty($federation->owners->middle_name))
                    <h4><strong>Middle name</strong></h4>
                    <p>{{ $federation->owners->middle_name }}</p>
                @endif

                @if( ! empty($federation->owners->date_of_birth))
                    <h4><strong>Date of birth</strong></h4>
                    <p>{{ $federation->owners->date_of_birth }}</p>
                @endif

                @if( ! empty($federation->owners->phone_number))
                    <h4><strong>Phone number</strong></h4>
                    <p>{{ $federation->owners->phone_number }}</p>
                @endif

                @if( ! empty($federation->owners->email_address))
                    <h4><strong>Email address</strong></h4>
                    <p>{{ $federation->owners->email_address }}</p>
                @endif
                
                @if( ! empty($federation->sports->name))
                <h4><strong>Sport</strong></h4>
                <p>{{ $federation->sports->name }}</p>
                @endif
                
                @if( count($federation->countries))
                <h4><strong> Federation Countries</strong></h4>
                 <p>
                    @foreach ($federation->countries as $countries)
                        @if( ! empty($countries->name ))
                            <span>{{ $countries->name }}</span><br>
                        @endif
                    @endforeach
                </p>
                @endif

            </div>
        </div>

        <div class="portlet light bordered">
            <div class="portlet-body form">
                <h3>Federation Subdomain</h3><br>
                
                @if( ! empty($federation->subdomains->subdomain_link))
                <h4><strong> Subdomain</strong></h4>
                <p>{{ $federation->subdomains->subdomain_link }}</p>
                @endif

            </div>
        </div>

    </div>

    <div class="col-sm-6">
        <div class="portlet light bordered">
            <div class="portlet-body form">
            <h3>Home Federation address</h3><br>
            
            @if( ! empty($federation->address_id))
            <div class="row">
                <div class="col-md-6">

                    @if( ! empty($federation->address->address1))
                    <h4><strong>Address 1</strong></h4>
                    <p>{{ $federation->address->address1 }} </p>
                    @endif

                </div>
                <div class="col-md-6">

                    @if( ! empty($federation->address->address2))
                    <h4><strong>Address 2</strong></h4>
                    <p>{{ $federation->address->address2 }} </p>
                    @endif

                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">

                    @if( ! empty($federation->address->city))
                    <h4><strong>City</strong></h4>
                    <p>{{ $federation->address->city }} </p>
                    @endif

                </div>
                <div class="col-md-6">

                    @if( ! empty($federation->address->region))
                    <h4><strong>Region</strong></h4>
                    <p>{{ $federation->address->region }} </p>
                    @endif

                </div>
            </div>

            <div class="row">
                <div class="col-md-6">

                    @if( ! empty($federation->address->zipcode))
                    <h4><strong>Zip Code</strong></h4>
                    <p>{{ $federation->address->zipcode }} </p>
                    @endif

                </div>
                <div class="col-md-6">

                    @if( ! empty($federation->address->country ))
                    <h4><strong>Country</strong></h4>
                    <p>{{ $federation->address->country }} </p>
                    @endif

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    @if( ! empty($federation->address->details ))
                    <h4><strong>Details</strong></h4>
                    <p>{{ $federation->address->details }} </p>
                    @endif

                </div>
            </div>
            
            @else 
            <div class="row">
                <div class="col-md-12">
                    <p>There is no address for this federation</p>
                </div>
            </div>
            @endif
                
            </div>
        </div>
    </div>
</div>

@endsection
