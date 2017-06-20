@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>{{ $subdomain->subdomain_link }}</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/dashboard">Dashboard</a>
        </li>
        <li>
            <a href="/subdomains/lists">Subdomains List</a>
        </li>
        <li class="active">{{ $subdomain->subdomain_link }}</li>
    </ol>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="portlet light bordered">
            <div class="portlet-body form">
                <h4><strong>Subdomain Link</strong></h4>
                <p>
                    {{ $subdomain->subdomain_link }}
                </p>

                @if (! empty($subdomain->web_server))
                    <h4><strong>Web Server</strong></h4>
                    <p>
                        {{ $subdomain->web_server->ip_address }}
                    </p>
                @endif

                @if (! empty($subdomain->database_server))
                    <h4><strong>Database Server</strong></h4>
                    <p>
                        {{ $subdomain->database_server->ip_address }}
                    </p>
                @endif
                
                <h4><strong>Database Name</strong></h4>
                <p>
                    {{ $subdomain->database_name }}
                </p>
                <h4><strong>Database User</strong></h4>
                <p>
                    {{ $subdomain->database_user }}
                </p>
            </div>
        </div>
    </div>
</div>

<div>
    <button class="btn btn-outline red" data-remove="/subdomains/remove/{{ $id }}"><i class="fa fa-trash"></i> Remove Subdomain</button>
</div>
@endsection
