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
            </div>
        </div>
    </div>
</div>

<div>
    <button class="btn btn-outline btn-circle red" data-remove="/subdomains/remove/{{ $id }}"><i class="fa fa-trash"></i> Remove Subdomain</button>
</div>
@endsection
