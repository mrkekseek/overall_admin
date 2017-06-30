@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>{{ $server->ip_address }}</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/dashboard">Dashboard</a>
        </li>
        <li>
            <a href="/servers/lists">Servers List</a>
        </li>
        <li class="active">{{ $server->ip_address }}</li>
    </ol>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="portlet light bordered">
            <div class="portlet-body form">
                @if( ! empty($subdomains->web_server_id))
                <h4><strong>Associated subdomains</strong></h4>

                @foreach($subdomains as $subdomain)
                <p>
                    {{ $subdomain->subdomain_link }}
                </p>
                @endforeach
                @endif

                @if( ! empty($server->server_type))
                <h4><strong>Server Type</strong></h4>

                <p>
                    {{ $server->server_type }}
                </p>
                @endif

                @if( ! empty($server->perfomance_level))
                <h4><strong>Perfomance Level</strong></h4>

                <p>
                    {{ $server->perfomance_level }}
                </p>
                @endif

                @if( ! empty($server->description))
                <h4><strong>Description</strong></h4>

                <p>
                    {{ $server->description }}
                </p>
                @endif
            </div>

            
        </div>
    </div>
</div>

@endsection
