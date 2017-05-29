@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>Add New Server</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/dashboard">Dashboard</a>
        </li>
        <li>
            <a href="/servers/lists">Servers List</a>
        </li>
        <li class="active">Add New Server</li>
    </ol>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 ">
        <div class="portlet light bordered">
            <div class="portlet-body form">
                <form role="form" action="/servers/add{{ ! empty($id) ? '/'.$id : '' }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}

                    <div class="form-body">
                        <div class="form-group{{ $errors->has('ip_address') ? ' has-error' : '' }}">
                            <label class="bold">Server IP</label>
                            <input name="ip_address" type="text" class="form-control" placeholder="Enter server IP" value="{{ old('ip_address') != null ? old('ip_address') : (isset($server->ip_address) ? $server->ip_address : '') }}" />
                            @if ($errors->has('ip_address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('ip_address') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="bold">Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description') != null ? old('description') : (isset($server->description) ? $server->description : '') }}</textarea>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn green">{{ ! empty($id) ? 'Save' : 'Add' }} Server</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
