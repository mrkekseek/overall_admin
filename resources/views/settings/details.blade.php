@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
	<h1>View User</h1>

	<ol class="breadcrumb">
		<li>
			<a href="/">Dashboard</a>
		</li>
		<li>
			<a href="/settings/users">Users</a>
		</li>
		<li class="active">View User</li>
	</ol>
</div>
@endsection

@section('content')
<div class="row">
	<div class="col-md-6 col-xs-12">
		<div class="portlet light bordered">
			<div class="portlet-body form">
				<h4>User details</h4>

				<div class="form-body">
					<div class="row">
						<div class="col-sm-6 col-xs-12 form-group">
							<label class="bold">Name</label>
							<p>{{ $user->name }}</p>
						</div>

						<div class="col-sm-6 col-xs-12 form-group">
							<label class="bold">Email Address</label>
							<p>{{ $user->email }}</p>
						 </div>
					</div>

					<div class="row">
						<div class="col-sm-6 col-xs-12 form-group">
							<label class="bold">Role</label>
							<p>{{ $user['roles']->first()['display_name'] or '' }}</p>
						</div>

						<div class="col-sm-6 col-xs-12 form-group">
							<label class="bold">Address</label>
							<p>{{ $user->address }}</p>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6 col-xs-12 form-group">
							<label class="bold">City</label>
							<p>{{ $user->city }}</p>
						</div>

						<div class="col-sm-6 col-xs-12 form-group">
							<label class="bold">Country</label>
							<p>{{ $user->country}}</p>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6 col-xs-12 form-group{{ $errors->has('country') ? ' has-error' : '' }}">
							<label class="bold">Phone</label>
							<p>{{ $user->phone_number }}</p>
						</div>

						<div class="col-sm-6 col-xs-12 form-group{{ $errors->has('country') ? ' has-error' : '' }}">
							<label class="bold">Status</label>
							<p>{{ $user->user_status }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-6 col-xs-12">
		<div class="portlet light bordered">
			<div class="portlet-body form">
				<h4>User activity</h4>
				<div class="form-body">
					<div class="table-scrollable table-users">
			            <table class="table table-hover table-light">
			                <thead>
			                    <tr>
			                        <th>Action</th>
			                        <th>Description</th>
			                        <th class="text-center">Details</th>
			                        <th class="text-center">Date of log</th>
			                    </tr>
			                </thead>

			                <tbody>
							    @foreach($logs as $log)
							    <tr>
							     	<td>{{ $log->action }}</td>
							     	<td>{{ $log->description }}</td>
							     	<td>{{ $log->details }}</td>
							     	<td>{{ $log->created_at }}</td>
							    </tr>
								@endforeach  
			                </tbody>
			            </table>
			        </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
