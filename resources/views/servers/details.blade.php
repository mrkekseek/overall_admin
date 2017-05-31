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
                <h4><strong>Description</strong></h4>

                <p>
                    {{ $server->description }}
                </p>
            </div>
        </div>
    </div>
</div>

<div>
    <button class="btn btn-outline btn-circle red" data-remove="/servers/remove/{{ $id }}"><i class="fa fa-trash"></i> Remove Server</button>
</div>
@endsection
