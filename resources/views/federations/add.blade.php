@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>Add New Federation</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/dashboard">Dashboard</a>
        </li>
        <li>
            <a href="/federations/lists">Federations List</a>
        </li>
        <li class="active">Add New Federation</li>
    </ol>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 ">
        <div class="portlet light bordered">
            <div class="portlet-body form">
                <form role="form" action="/federations/add" method="post">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}

                    <div class="form-body">
                        <div class="form-group">
                            <label class="bold">Federation name</label>
                            <input name="name" type="text" class="form-control" placeholder="Enter federation name" />
                        </div>
                        <div class="form-group">
                            <label class="bold">Add/select federation contact person</label>
                            <select name="owner_id" class="form-control">
                                <option value="1">Add new person</option>
                                <option value="2">Person 2</option>
                                <option value="3">Person 3</option>
                                <option value="4">Person 4</option>
                                <option value="5">Person 5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter name contact person" />
                        </div>
                        <div class="portlet light bordered">
                            <div class="bold">Add federation details</div>
                            <div class="portlet-body">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select name="country" class="form-control">
                                        <option value="us">United States</option>
                                        <option value="fr">France</option>
                                        <option value="uk">United Kingdom</option>
                                        <option value="ua">Ukraine</option>
                                        <option value="pl">Poland</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Sport</label>
                                    <input type="text" class="form-control" placeholder="Enter sport" />
                                </div>
                            </div>
                        </div>
                        <div class="form-actions right">
                            <button type="submit" class="btn green">Add federation</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
