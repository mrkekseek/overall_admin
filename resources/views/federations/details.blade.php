@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>{{ $federation->name }}</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/dashboard">Dashboard</a>
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
    <div class="col-sm-6">
        <div class="portlet light bordered">
            <div class="portlet-body form">
                <h4><strong>Details of the contact person</strong></h4>

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
                <h4><strong>Other contact details</strong></h4>

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
                <h4><strong>List of available clubs</strong></h4>

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
                <h4><strong>Details for the federation</strong></h4>

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



@endsection
