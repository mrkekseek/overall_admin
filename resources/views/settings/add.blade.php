@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>{{ ! empty($id) ? 'Edit' : 'Add New' }} User</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/dashboard">Dashboard</a>
        </li>
        <li>
            <a href="/settings/users">Users</a>
        </li>
        <li class="active">{{ ! empty($id) ? 'Edit' : 'Add New' }} User</li>
    </ol>
</div>
@endsection

@section('content')
<form role="form" action="/settings/add{{ ! empty($id) ? '/'.$id : '' }}" method="post">
	{{ csrf_field() }}
	{{ method_field('POST') }}

	<div class="row">
	    <div class="col-md-6 col-xs-12">
	        <div class="portlet light bordered">
	            <div class="portlet-body form">
	            	<h4>New user details</h4>

	            	<div class="form-body">
		                <div class="row">
		                    <div class="col-sm-6 col-xs-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		                        <label class="bold">Name</label>
		                        <input type="text" class="form-control" name="name" value="{{ old('name') != null ? old('name') : (isset($user->name) ? $user->name : '') }}" />
		                        @if ($errors->has('name'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('name') }}</strong>
	                                </span>
	                            @endif
		                    </div>

		                    <div class="col-sm-6 col-xs-12 form-group{{ $errors->has('role') ? ' has-error' : '' }}">
			                    <label class="bold">Role</label>
		                        <select name="role" class="form-control">
		                        	<option value="">Select a role from a list</option>
		                            @foreach ($roles as $role)
		                            	<option value="{{ $role->id }}" {{ (old('role') == $role->id || old('role') == null && isset($user->roles) && $user->roles->first()['id'] == $role->id) ? 'selected="selected"' : '' }}>{{ $role->display_name }}</option>
		                            @endforeach
		                        </select>
		                        @if ($errors->has('role'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('role') }}</strong>
	                                </span>
	                            @endif
		               		 </div>
		                </div>

		                <div class="row">
		                	<div class="col-sm-6 col-xs-12 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		                        <label class="bold">Email Address</label>
		                        <input type="email" class="form-control" name="email" value="{{ old('email') != null ? old('email') : (isset($user->email) ? $user->email : '') }}" />
		                        @if ($errors->has('email'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('email') }}</strong>
	                                </span>
	                            @endif
		                    </div>

		                	<div class="col-sm-6 col-xs-12 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
		                        <label class="bold">Password</label>
		                        <input type="password" class="form-control" name="password" value="" />
		                        @if ($errors->has('password'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('password') }}</strong>
	                                </span>
	                            @endif
		                    </div>
		                </div>

		                <div class="row">
		                	<div class="col-sm-6 col-xs-12 form-group{{ $errors->has('address') ? ' has-error' : '' }}">
		                        <label class="bold">Address</label>
		                        <input type="text" class="form-control" name="address" value="{{ old('address') != null ? old('address') : (isset($user->address) ? $user->address : '') }}" />
		                        @if ($errors->has('address'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('address') }}</strong>
	                                </span>
	                            @endif
		                    </div>

		                	<div class="col-sm-6 col-xs-12 form-group{{ $errors->has('city') ? ' has-error' : '' }}">
		                        <label class="bold">City</label>
		                        <input type="text" class="form-control" name="city" value="{{ old('city') != null ? old('city') : (isset($user->city) ? $user->city : '') }}" />
		                        @if ($errors->has('city'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('city') }}</strong>
	                                </span>
	                            @endif
		                    </div>
		                </div>

		                <div class="row">
		                	<div class="col-sm-6 col-xs-12 form-group{{ $errors->has('country') ? ' has-error' : '' }}">
		                        <label class="bold">Country</label>
		                        <select name="country" class="form-control">
		                            <option value="" {{ (old('country') == '' || old('country') == null && isset($user->country) && $user->country == '') ? 'selected="selected"' : '' }}>Select country from a list</option>
		                            <option value="US" {{ (old('country') == 'US' || old('country') == null && isset($user->country) && $user->country == 'US') ? 'selected="selected"' : '' }}>United States</option>
		                            <option value="FR" {{ (old('country') == 'FR' || old('country') == null && isset($user->country) && $user->country == 'FR') ? 'selected="selected"' : '' }}>France</option>
		                            <option value="UK" {{ (old('country') == 'UK' || old('country') == null && isset($user->country) && $user->country == 'UK') ? 'selected="selected"' : '' }}>United Kingdom</option>
		                            <option value="UA" {{ (old('country') == 'UA' || old('country') == null && isset($user->country) && $user->country == 'UA') ? 'selected="selected"' : '' }}>Ukraine</option>
		                            <option value="PL" {{ (old('country') == 'PL' || old('country') == null && isset($user->country) && $user->country == 'PL') ? 'selected="selected"' : '' }}>Poland</option>
		                        </select>
		                        @if ($errors->has('country'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('country') }}</strong>
	                                </span>
	                            @endif
		                    </div>
		                </div>
		            </div>
	            </div>
	        </div>
	    </div>
	</div>

	<div class="text-center">
	    <button type="submit" class="btn green">{{ ! empty($id) ? 'Save' : 'Add' }} User</button>
	</div>
</form>
@endsection
