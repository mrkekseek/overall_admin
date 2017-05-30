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

                        <label class="bold">Add/select federation contact person</label>
                        <div class="row">
                            <div class="col-xs-12 form-group contact-person-list {{ ! empty($federation->owner_id) || old('owner_id') != null ? 'col-sm-12' : 'col-sm-6'}}">
                                <select name="owner_id" class="form-control">
                                    <option value="0" {{ (old('owner_id') == '0' || old('owner_id') == null && isset($federation->owner_id) && $federation->owner_id == '0') ? 'selected="selected"' : '' }}>Add new person</option>
                                    <option value="1" {{ (old('owner_id') == '1' || old('owner_id') == null && isset($federation->owner_id) && $federation->owner_id == '1') ? 'selected="selected"' : '' }}>Person 2</option>
                                    <option value="2" {{ (old('owner_id') == '2' || old('owner_id') == null && isset($federation->owner_id) && $federation->owner_id == '2') ? 'selected="selected"' : '' }}>Person 3</option>
                                    <option value="3" {{ (old('owner_id') == '3' || old('owner_id') == null && isset($federation->owner_id) && $federation->owner_id == '3') ? 'selected="selected"' : '' }}>Person 4</option>
                                    <option value="4" {{ (old('owner_id') == '4' || old('owner_id') == null && isset($federation->owner_id) && $federation->owner_id == '4') ? 'selected="selected"' : '' }}>Person 5</option>
                                </select>
                            </div>

                            <div class="col-xs-12 form-group contact-person-name{{ $errors->has('new_contact_person') ? ' has-error' : '' }} {{ ! empty($federation->owner_id) || old('owner_id') != null ? 'hidden' : 'col-sm-6'}}">
                                <input name="new_contact_person" type="text" class="form-control" placeholder="Enter name of new contact person" value="{{ old('new_contact_person') != null ? old('new_contact_person') : (isset($federation->new_contact_person) ? $federation->new_contact_person : '') }}" />
                                @if ($errors->has('new_contact_person'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_contact_person') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-xs-12 form-group">
                                <div class="form-group">
                                    <label class="bold">Country</label>
                                    <select name="country" class="form-control">
                                        <option value="" {{ (old('country') == '' || old('country') != null && isset($federation->country) && $federation->country == '') ? 'selected="selected"' : '' }}>Select country from a list</option>
                                        <option value="US" {{ (old('country') == 'US' || old('country') == null && isset($federation->country) && $federation->country == 'US') ? 'selected="selected"' : '' }}>United States</option>
                                        <option value="FR" {{ (old('country') == 'FR' || old('country') == null && isset($federation->country) && $federation->country == 'FR') ? 'selected="selected"' : '' }}>France</option>
                                        <option value="UK" {{ (old('country') == 'UK' || old('country') == null && isset($federation->country) && $federation->country == 'UK') ? 'selected="selected"' : '' }}>United Kingdom</option>
                                        <option value="UA" {{ (old('country') == 'UA' || old('country') == null && isset($federation->country) && $federation->country == 'UA') ? 'selected="selected"' : '' }}>Ukraine</option>
                                        <option value="PL" {{ (old('country') == 'PL' || old('country') == null && isset($federation->country) && $federation->country == 'PL') ? 'selected="selected"' : '' }}>Poland</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xs-12 form-group">
                                <div class="form-group">
                                    <label class="bold">Sport</label>
                                    <input name="sport" type="text" class="form-control" placeholder="Enter sport" value="{{ old('sport') != null ? old('sport') : (isset($federation->sport) ? $federation->sport : '') }}" />
                                </div>
                            </div>
                        </div>
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
@endsection
