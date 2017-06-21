@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>{{ $club->name }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="/dashboard">Dashboard</a>
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
                <h4><strong>Available locations in the account</strong></h4>

                <ul>
                    <li>Option 1</li>
                    <li>Option 2</li>
                    <li>Option 3</li>
                    <li>Option 4</li>
                    <li>Option 5</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="portlet light bordered">
            <div class="portlet-body form">
                <h4><strong>Available courts in all locations</strong></h4>

                <ul>
                    <li>Option 1</li>
                    <li>Option 2</li>
                    <li>Option 3</li>
                    <li>Option 4</li>
                    <li>Option 5</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="portlet light bordered">
            <div class="portlet-body form">
                <h4><strong>List of invoices</strong></h4>

                <ul>
                    <li>Option 1</li>
                    <li>Option 2</li>
                    <li>Option 3</li>
                    <li>Option 4</li>
                    <li>Option 5</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="portlet light bordered">
            <div class="portlet-body form">
                <h4><strong>Small report for player growth</strong></h4>

                <ul>
                    <li>Option 1</li>
                    <li>Option 2</li>
                    <li>Option 3</li>
                    <li>Option 4</li>
                    <li>Option 5</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div>
    <button class="btn btn-outline red" data-remove="/clubs/remove/{{ $id }}"><i class="fa fa-trash"></i> Remove Account</button>
</div>

@endsection
