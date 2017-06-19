@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>{{ ! empty($id) ? 'Edit' : 'Add New' }} Club</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/dashboard">Dashboard</a>
        </li>
        <li>
            <a href="/clubs/lists">Clubs List</a>
        </li>
        <li class="active">{{ ! empty($id) ? 'Edit' : 'Add New' }} Club</li>
    </ol>
</div>
@endsection

@section('content')
<form role="form" action="/clubs/add{{ ! empty($id) ? '/'.$id : '' }}" method="post">
    {{ csrf_field() }}
    {{ method_field('POST') }}

    <div class="row">
        <div class="col-md-6 col-xs-12">
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
                                    <option></option>
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
                                    <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#add-owner"><i class="fa fa-plus-circle"></i></button>
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
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="portlet light bordered">
                        <div class="portlet-body form">
                            <h4>Assign Club to Subdomain</h4>

                            <div class="form-group">
                                <select name="assign_subdomain" class="form-control">
                                    <option value="">Select subdomain from a list</option>
                                    @foreach ($subdomains as $subdomain)
                                        <option value="{{ $subdomain->id }}" {{ (old('assign_subdomain') == $subdomain->id || old('assign_subdomain') == null) ? 'selected="selected"' : '' }}>{{ $subdomain->subdomain_link }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xs-12">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <h4>Home club address</h4>

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                                <label class="bold">Address 1</label>
                                <input name="address1" type="text" class="form-control" value="{{ old('address1') != null ? old('address1') : (isset($club->address->address1) ? $club->address->address1 : '') }}" />
                                @if ($errors->has('address1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address1') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 col-xs-12 form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
                                <label class="bold">Address 2</label>
                                <input name="address2" type="text" class="form-control" value="{{ old('address2') != null ? old('address2') : (isset($club->address->address2) ? $club->address->address2 : '') }}" />
                                @if ($errors->has('address2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label class="bold">City</label>
                                <input name="city" type="text" class="form-control" value="{{ old('city') != null ? old('city') : (isset($club->address->city) ? $club->address->city : '') }}" />
                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 col-xs-12 form-group{{ $errors->has('region') ? ' has-error' : '' }}">
                                <label class="bold">Region</label>
                                <input name="region" type="text" class="form-control" value="{{ old('region') != null ? old('region') : (isset($club->address->region) ? $club->address->region : '') }}" />
                                @if ($errors->has('region'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('region') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                                <label class="bold">Zip Code</label>
                                <input name="zipcode" type="text" class="form-control" value="{{ old('zipcode') != null ? old('zipcode') : (isset($club->address->zipcode) ? $club->address->zipcode : '') }}" />
                                @if ($errors->has('zipcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zipcode') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 col-xs-12 form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                                <label class="bold">Country</label>
                                <select name="country" class="form-control">
                                    <option value="">Select country from a list</option>
                                    @foreach($countries as $country)
                                         <option value="{{ $country->id }}" {{ (old('country') == $country->id || old('country') == null && isset($club->address->country) && $club->address->country == $country->full_name) ? 'selected="selected"' : '' }}>{{ $country->full_name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 form-group">
                                <label class="bold">Details</label>
                                <textarea name="address_details" class="form-control" rows="3">{{ old('address_details') != null ? old('address_details') : (isset($club->address->details) ? $club->address->details : '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="btn green">{{ ! empty($id) ? 'Save' : 'Add' }} club</button>
    </div>
</form>

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
                <div class="alert-box">
                </div>

                <div class="row">
                    <div class="col-sm-6 col-xs-12 form-group">
                        <label class="bold">First Name</label>
                        <input type="text" class="form-control" name="first_name" required="required" />
                        <span class="help-block">First Name is required</span>
                    </div>

                    <div class="col-sm-6 col-xs-12 form-group">
                        <label class="bold">Last Name</label>
                        <input type="text" class="form-control" name="last_name" required="required" />
                        <span class="help-block">Last Name is required</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-xs-12 form-group">
                        <label class="bold">Middle Name</label>
                        <input type="text" class="form-control" name="middle_name" />
                    </div>

                    <div class="col-sm-6 col-xs-12 form-group">
                        <label class="bold">Country</label>
                        <select name="country" class="form-control">
                            <option value="">Select country from a list</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ (old('country') == $country->id || old('country') == null && isset($club->address->country) && $club->address->country == $country->id) ? 'selected="selected"' : '' }}>{{ $country->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-xs-12 form-group">
                        <label class="bold">Email Address</label>
                        <input type="email" class="form-control" name="email_address" required="required" />
                        <span class="help-block">Email Address is required</span>
                    </div>

                    <div class="col-sm-6 col-xs-12 form-group">
                        <label class="bold">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" />
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
