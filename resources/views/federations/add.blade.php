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
<div class="row">
    <div class="col-md-6 ">
        <div class="portlet light bordered">
            <div class="portlet-body form">
                <form role="form" action="/federations/add{{ ! empty($id) ? '/'.$id : '' }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}

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

                        <div class="text-right">
                            <button type="submit" class="btn green">{{ ! empty($id) ? 'Save' : 'Add' }} federation</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
