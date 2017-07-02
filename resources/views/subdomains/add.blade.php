@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
   <h1>{{ ! empty($id) ? 'Edit' : 'Add New' }} Subdomain</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/">Dashboard</a>
        </li>
        <li>
            <a href="/subdomains/lists">Subdomains List</a>
        </li>
        <li class="active">Add New Subdomain</li>
    </ol>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="portlet light bordered">
            <div class="portlet-body form">
                <form role="form" action="/subdomains/add{{ ! empty($id) ? '/'.$id : '' }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}

                    <div class="form-body">
                        <div class="form-group{{ $errors->has('subdomain_link') ? ' has-error' : '' }}">
                            <label class="bold">Subdomain Link</label>
                            <input name="subdomain_link" type="text" class="form-control" placeholder="Subdomain Link" value="{{ old('subdomain_link') != null ? old('subdomain_link') : (isset($subdomain->subdomain_link) ? $subdomain->subdomain_link : '') }}" />
                            @if ($errors->has('subdomain_link'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('subdomain_link') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('web_server') ? ' has-error' : '' }}">
                            <label class="bold">Web Server</label>
                            <select name="web_server" class="form-control">
                                <option value="">Select web server from a list</option>
                            @foreach($web_servers as $web_server)
                                <option value="{{ $web_server->id }}" {{ (old('web_server') == $web_server->id || old('web_server') == null && isset($subdomain->web_server_id) && $subdomain->web_server_id == $web_server->id) ? 'selected="selected"' : '' }}> {{ $web_server->ip_address }}</option>
                            @endforeach
                            </select>

                            @if ($errors->has('web_server'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('web_server') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('database_server') ? ' has-error' : '' }}">
                            <label class="bold">Database Server</label>
                            <select name="database_server" class="form-control">
                                <option value="">Select database server from a list</option>
                            @foreach($database_servers as $database_server)
                                <option value="{{ $database_server->id }}" {{ (old('database_server') == $database_server->id || old('database_server') == null && isset($subdomain->database_server_id) && $subdomain->database_server_id == $database_server->id) ? 'selected="selected"' : '' }}>{{ $database_server->ip_address }}</option>
                            @endforeach
                            </select>
                            @if ($errors->has('database_server'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('database_server') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('database_name') ? ' has-error' : '' }}">
                            <label class="bold">Database Name</label>
                            <input name="database_name" type="text" class="form-control" placeholder="Database Name" value="{{ old('database_name') != null ? old('database_name') : (isset($subdomain->database_name) ? $subdomain->database_name : '') }}" />
                            @if ($errors->has('database_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('database_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('database_user') ? ' has-error' : '' }}">
                            <label class="bold">Database User</label>
                            <input name="database_user" type="text" class="form-control" placeholder="Database User" value="{{ old('database_user') != null ? old('database_user') : (isset($subdomain->database_user) ? $subdomain->database_user : '') }}"   />
                            @if ($errors->has('database_user'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('database_user') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('database_password') ? ' has-error' : '' }}">
                            <label class="bold">Database Password</label>
                            <input name="database_password" type="text" class="form-control" placeholder="Database Password" value="" />
                            @if ($errors->has('database_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('database_password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn green">{{ ! empty($id) ? 'Save' : 'Add' }} Subdomain</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if(! empty($subdomain->subdomain_link))
<div>
    <button class="btn red" data-remove="/subdomains/remove/{{ $id }}"><i class="fa fa-trash"></i> Remove Subdomain</button>
</div>
@endif

@endsection
