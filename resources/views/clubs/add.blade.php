@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>Add New Club</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/">Dashboard</a>
        </li>
        <li>
            <a href="/clubs/lists">Clubs List</a>
        </li>
        <li class="active">Add New Club</li>
    </ol>
</div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-xs-12">
        <form role="form" id="club_add_form" action="/clubs/add" method="post">
            {{ csrf_field() }}
            {{ method_field('POST') }}
            
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <h4>Basic Information</h4>

                    <div class="form-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="bold">Club name</label>
                            <input name="name" type="text" class="form-control" placeholder="Enter club name" value="{{ old('name') != null ? old('name') : (isset($club->name) ? $club->name : '') }}" />

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif

                        </div>

                        <label class="bold">Club owner</label>
                        <div class="row">
                            <div class="col-lg-10 col-sm-9 col-xs-12 form-group{{ $errors->has('owner_id') ? ' has-error' : '' }}">
                                <select name="owner_id" class="form-control" data-placeholder="Select an Owner">
                                    <option value=""></option>

                                @foreach ($owners as $owner)
                                    <option value="{{ $owner->id }}"  {{ (old('owner_id') == $owner->id || old('owner_id') == null && isset($club->owner_id) && $club->owner_id == $owner->id) ? 'selected="selected"' : '' }}>{{ $owner->first_name }} {{ $owner->last_name }}</option>
                                @endforeach

                                </select>

                                @if ($errors->has('owner_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('owner_id') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="col-lg-2 col-sm-3 col-xs-12 form-group">
                                <div data-toggle="tooltip" data-placement="top" title="Add owner">
                                    <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#add-owner">
                                        <i class="fa fa-plus-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="bold">Basic club details</label>
                            <textarea name="details" class="form-control" rows="3">{{ old('details') != null ? old('details') : (isset($club->details) ? $club->details : '') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="bold">Sport</label>
                            <select name="main_sport_id" class="form-control">
                                <option value="0" {{ (old('main_sport_id') == '0' || old('main_sport_id') == null && isset($club->main_sport_id) && $club->main_sport_id == '0') ? 'selected="selected"' : '' }}>Choose clubs sport</option>

                            @foreach ($sports as $sport)
                                <option value="{{ $sport->id }}" {{ (old('main_sport_id') == $sport->id || old('main_sport_id') == null && isset($club->main_sport_id) && $club->main_sport_id == $sport->id) ? 'selected="selected"' : '' }}>{{ $sport->name }}</option>
                            @endforeach

                            </select>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn green"> Add club</button>
                        </div>
                    </div>
                </div>
            </div>
            
            @if( count($subdomains) ||  empty($subdomains ))
            <div class="row">
                <div class="col-xs-12">
                    <div class="portlet light bordered">
                        <div class="portlet-body form">
                            <h4>Assign Club to Subdomain</h4>
                            <h5 class="font-blue">To assign club to Subdomain, please, go to Manage</h5>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            </form>
        </div>
        
        <div class="col-md-6 col-xs-12">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <h4>Home club address</h4>
                    <h5 class="font-blue">To add Your Home club address, please, go to Manage</h5>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade" id="add-owner" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/ajax/clubs/clubsOwnersSave/" method="post" class="modal-content formAjax" data-callback="clubsOwnersSaved">
            {{ csrf_field() }}
            {{ method_field('POST') }}

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add new Club Owner</h4>
            </div>

            <div class="modal-body">
                <div class="alert-box"></div>

                <div class="row">
                    <div class="col-sm-6 col-xs-12 form-group">
                        <label class="bold">First Name</label>
                        <input type="text" class="form-control" name="first_name" required="required" />
                        <span class="help-block">First Name is required</span>
                    </div>

                    <div class="col-sm-6 col-xs-12 form-group">
                        <label class="bold">Date of Birth</label>
                        <div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
                            <input type="text" class="form-control form-control-color" readonly name="date_of_birth">
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-xs-12 form-group">
                        <label class="bold">Middle Name</label>
                        <input type="text" class="form-control" name="middle_name" />
                    </div>
    
                     <div class="col-sm-6 col-xs-12 form-group">
                        <label class="bold">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" />
                    </div>
                </div>

                <div class="row">
                     <div class="col-sm-6 col-xs-12 form-group">
                        <label class="bold">Last Name</label>
                        <input type="text" class="form-control" name="last_name" required="required" />
                        <span class="help-block">Last Name is required</span>
                    </div>
                    
                    <div class="col-sm-6 col-xs-12 form-group">
                        <label class="bold">Email Address</label>
                        <input type="email" class="form-control" name="email_address" required="required" />
                        <span class="help-block">Email Address is required</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-xs-12 form-group">
                        <label class="bold">Gender</label>
                        <select name="gender" class="form-control">
                            <option value="">Select gender from a list</option>
                            <option value="m">Male</option>
                            <option value="f">Female</option>
                        </select>
                    </div>

                    <div class="col-sm-6 col-xs-12 form-group">
                        <label class="bold">Country</label>
                        <select name="country" class="form-control">
                            <option value="">Select country from a list</option>

                        @foreach($countries as $country)
                            <option value="{{ $country->iso_3166_2 }}" {{ (old('country') == $country->id || old('country') == null && isset($club->address->country) && $club->address->country == $country->name) ? 'selected="selected"' : '' }}>{{ $country->name }}</option>
                        @endforeach
                        
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                <button type="submit" class="btn green">Add</button>
            </div>
        </form>
    </div>
</div>
@endsection
