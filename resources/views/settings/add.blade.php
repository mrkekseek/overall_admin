@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>Add user</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/dashboard">Dashboard</a>
        </li>
        <li class="active">Settings Add user</li>
    </ol>
</div>
@endsection

@section('content')
<form role="form" action="/settings/addNewUser" method="post">
	{{ csrf_field() }}
	{{ method_field('POST') }}

	<div class="row">
	    <div class="col-md-6 col-xs-12">
	        <div class="portlet light bordered">
	            <div class="portlet-body form">
	            	<h4>New user details</h4>

	            	<div class="form-body">
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
		                        <label class="bold">Email Address</label>
		                        <input type="email" class="form-control" name="email_address" required="required" />
		                        <span class="help-block">Email Address is required</span>
		                    </div>

		                    <div class="col-sm-6 col-xs-12 form-group">
			                    <label class="bold">Role</label>
		                        <select name="role" class="form-control">
		                        	<option value="">Select a role from a list</option>
		                            <option value="0">Administrator</option>
		                            <option value="1">Employee</option>
		                        </select>
		               		 </div>
		                </div>

		                <div class="row">
		                    <div class="col-sm-6 col-xs-12 form-group">
		                        <label class="bold">Address</label>
		                        <input type="text" class="form-control" name="address" required="required" />
		                    </div>

		                    <div class="col-sm-6 col-xs-12 form-group">
		                        <label class="bold">City</label>
		                        <input type="text" class="form-control" name="city" required="required" />
		                    </div>
		                </div>

		                <div class="row">
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
		            </div>
	            </div>
	        </div>
	    </div>
	</div>

	<div class="text-center">
	    <button type="submit" class="btn green">Add new user</button>
	</div>
</form>
@endsection
