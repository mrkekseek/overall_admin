@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>{{ ! empty($id) ? 'Edit' : 'Add New' }} Federation</h1>
   
    <ol class="breadcrumb">
        <li>
            <a href="/dashboard">Dashboard</a>
        </li>
        <li>
            <a href="/federations/lists">Federations List</a>
        </li>
        <li class="active">{{ ! empty($id) ? 'Edit' : 'Add New' }} Federation</li>
    </ol>
</div>
@endsection

@section('content')
<form role="form" action="/federations/add{{ ! empty($id) ? '/'.$id : '' }}" method="post">
    {{ csrf_field() }}
    {{ method_field('POST') }}

    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <h4>Basic Information</h4>

                    <div class="form-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="bold">Federation name</label>
                            <input name="name" type="text" class="form-control" placeholder="Enter federation name" value="{{ old('name') != null ? old('name') : (isset($federation->name) ? $federation->name : '') }}" />
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <label class="bold">Federation Contact Person</label>
                        <div class="row">
                            <div class="col-md-11 col-xs-12 form-group{{ $errors->has('owner_id') ? ' has-error' : '' }}">
                                <select name="owner_id" class="form-control" data-placeholder="Select a Contact Person">
                                    <option></option>
                                    @foreach ($owners as $owner)
                                        <option value="{{ $owner->id }}"  {{ (old('owner_id') == $owner->id || old('owner_id') == null && isset($federation->owner_id) && $federation->owner_id == $owner->id) ? 'selected="selected"' : '' }}>{{ $owner->first_name }} {{ $owner->last_name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('owner_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('owner_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-1 col-xs-12 form-group">
                                <div data-toggle="tooltip" data-placement="top" title="Add contact person">
                                    <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#add-owner" ><i class="fa fa-plus-circle"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="bold">Sport</label>
                            <select name="sport_id" class="form-control">
                                <option value="0" {{ (old('sport_id') == '0' || old('sport_id') == null && isset($federation->sport_id) && $federation->sport_id == '0') ? 'selected="selected"' : '' }}>Choose federation sport</option>
                                @foreach ($sports as $sport)
                                    <option value="{{ $sport->id }}" {{ (old('sport_id') == $sport->id || old('sport_id') == null && isset($federation->sport_id) && $federation->sport_id == $sport->id) ? 'selected="selected"' : '' }}>{{ $sport->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <h4>Import members</h4>

                    <div class="form-body">
                        <form role="form" action="/federations/import" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}

                            <div class="form-group{{ $errors->has('file') || $errors->has('extension') ? ' has-error' : '' }}">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="input-group input-large">
                                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                            <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                            <span class="fileinput-filename"> </span>
                                        </div>

                                        <span class="input-group-addon btn default btn-file">
                                            <span class="fileinput-new">Select file</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="file" />
                                        </span>

                                        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>

                                @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif

                                @if ($errors->has('extension'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('extension') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div>
                                <button type="submit" class="btn btn-outline btn-circle blue"><i class="fa fa-upload"></i> Upload</button>
                            </div>
                        </form>
                    </div>
                </div>    
            </div>    
        </div>

        <div class="col-md-6 col-xs-12">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <h4>Home federation address</h4>

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                                <label class="bold">Address 1</label>
                                <input name="address1" type="text" class="form-control" value="{{ old('address1') != null ? old('address1') : (isset($federation->address->address1) ? $federation->address->address1 : '') }}" />
                                @if ($errors->has('address1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address1') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 col-xs-12 form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
                                <label class="bold">Address 2</label>
                                <input name="address2" type="text" class="form-control" value="{{ old('address2') != null ? old('address2') : (isset($federation->address->address2) ? $federation->address->address2 : '') }}" />
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
                                <input name="city" type="text" class="form-control" value="{{ old('city') != null ? old('city') : (isset($federation->address->city) ? $federation->address->city : '') }}" />
                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 col-xs-12 form-group{{ $errors->has('region') ? ' has-error' : '' }}">
                                <label class="bold">Region</label>
                                <input name="region" type="text" class="form-control" value="{{ old('region') != null ? old('region') : (isset($federation->address->region) ? $federation->address->region : '') }}" />
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
                                <input name="zipcode" type="text" class="form-control" value="{{ old('zipcode') != null ? old('zipcode') : (isset($federation->address->zipcode) ? $federation->address->zipcode : '') }}" />
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
                                    <option value="US" {{ (old('country') == 'US' || old('country') == null && isset($federation->address->country) && $federation->address->country == 'US') ? 'selected="selected"' : '' }}>United States</option>
                                    <option value="FR" {{ (old('country') == 'FR' || old('country') == null && isset($federation->address->country) && $federation->address->country == 'FR') ? 'selected="selected"' : '' }}>France</option>
                                    <option value="UK" {{ (old('country') == 'UK' || old('country') == null && isset($federation->address->country) && $federation->address->country == 'UK') ? 'selected="selected"' : '' }}>United Kingdom</option>
                                    <option value="UA" {{ (old('country') == 'UA' || old('country') == null && isset($federation->address->country) && $federation->address->country == 'UA') ? 'selected="selected"' : '' }}>Ukraine</option>
                                    <option value="PL" {{ (old('country') == 'PL' || old('country') == null && isset($federation->address->country) && $federation->address->country == 'PL') ? 'selected="selected"' : '' }}>Poland</option>
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
                                <textarea name="address_details" class="form-control" rows="3">{{ old('address_details') != null ? old('address_details') : (isset($federation->address->details) ? $federation->address->details : '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="btn green">{{ ! empty($id) ? 'Save' : 'Add' }} federation</button>
    </div>
</form>

<div class="modal fade" id="add-owner" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/api/federations/federationsOwnersSave/" method="post" class="modal-content formAjax" data-callback="federationsOwnersSaved">
            {{ csrf_field() }}
            {{ method_field('POST') }}

            <input type="hidden" name="federation_id", value="{{ isset($federation->id) ? $federation->id : 0 }}" />

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add new Federation Contact Person</h4>
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
                            <option value="US">United States</option>
                            <option value="FR">France</option>
                            <option value="UK">United Kingdom</option>
                            <option value="UA">Ukraine</option>
                            <option value="PL">Poland</option>
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
