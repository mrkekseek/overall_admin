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
                <h4><strong>Associated subdomains</strong></h4>

                @foreach($subdomains as $subdomain)
                <p>
                    {{ $subdomain->subdomain_link }}
                </p>
                @endforeach

                <h4><strong>Server Type</strong></h4>

                <p>
                    {{ $server->server_type }}
                </p>

                <h4><strong>Perfomance Level</strong></h4>

                <p>
                    {{ $server->perfomance_level }}
                </p>

                <h4><strong>Description</strong></h4>

                <p>
                    {{ $server->description }}
                </p>
            </div>

            <form role="form" action="/servers/filled/{{ $id }}" method="post">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                
                <div>
                    <button type="submit" class="btn btn-outline btn-circle blue">Mark as Filled</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if(empty($subdomain))
<div>
    <button class="btn btn-outline btn-circle red" data-remove="/servers/remove/{{ $id }}"><i class="fa fa-trash"></i> Remove Server</button>
</div>
@endif
@endsection
