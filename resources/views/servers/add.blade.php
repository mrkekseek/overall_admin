@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
   <h1>{{ ! empty($id) ? 'Edit' : 'Add New' }} Server</h1>

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

                        <div class="row">
                            <div class="col-sm-6 col-xs-12 form-group{{ $errors->has('server_type') ? ' has-error' : '' }}">
                                <label class="bold">Server Type</label>
                                <select name="server_type" class="form-control">
                                    <option value="">Select server type from a list</option>
                                        <option value="web" {{ (old('server_type') == "web") || isset($server->server_type) && $server->server_type == "web" ? 'selected="selected"' : '' }}>Web</option>
                                        <option value="fileserver" {{ (old('server_type') == "fileserver") || isset($server->server_type) && $server->server_type == "fileserver" ? 'selected="selected"' : '' }}>Fileserver</option>
                                        <option value="database" {{ (old('server_type') == "database") || isset($server->server_type) && $server->server_type == "database" ? 'selected="selected"' : '' }}>Database</option>
                                        <option value="backup" {{ (old('server_type') == "backup") || isset($server->server_type) && $server->server_type == "backup" ? 'selected="selected"' : '' }}>Backup</option>
                                </select>
                                @if ($errors->has('server_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('server_type') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-sm-6 col-xs-12 form-group{{ $errors->has('perfomance_level') ? ' has-error' : '' }}">
                                <label class="bold">Performance Level</label>
                                <select name="perfomance_level" class="form-control">
                                    <option value="">Select performance level from a list</option>
                                    <option value="1" {{ (old('perfomance_level') == "1") || isset($server->perfomance_level) && $server->perfomance_level == "1" ? 'selected="selected"' : ''  }}>1</option>
                                    <option value="2" {{ (old('perfomance_level') == "2") || isset($server->perfomance_level) && $server->perfomance_level == "2" ? 'selected="selected"' : ''  }}>2</option>
                                    <option value="3" {{ (old('perfomance_level') == "3") || isset($server->perfomance_level) && $server->perfomance_level == "3" ? 'selected="selected"' : ''  }}>3</option>
                                    <option value="4" {{ (old('perfomance_level') == "4") || isset($server->perfomance_level) && $server->perfomance_level == "4" ? 'selected="selected"' : ''  }}>4</option>
                                    <option value="5" {{ (old('perfomance_level') == "5") || isset($server->perfomance_level) && $server->perfomance_level == "5" ? 'selected="selected"' : ''  }}>5</option>
                                </select>
                                @if ($errors->has('perfomance_level'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('perfomance_level') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="bold">Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description') != null ? old('description') : (isset($server->description) ? $server->description : '') }}</textarea>
                        </div>

                        <div class="text-right form-group">
                            <button type="submit" class="btn green">{{ ! empty($id) ? 'Save' : 'Add' }} Server</button>
                        </div>
                        
                        <div class="portlet-body form">
                            <div class="form-group">
                                <form role="form" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('POST') }}
                                    <input type="hidden" name="filled" value="{{ empty($server->is_filled) ? '1' : '0'}}" />

                                   
                                    <div class="text-right">
                                        @if( isset($server->is_filled)  && $server->is_filled == 0)
                                        <button type="button" class="btn blue" id="sendFilled" data-id="{{ $id }}">Mark as filled</button>
                                        @endif
                                    </div>
                    
                                </form>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if( ! empty($server->ip_address))
<div>
    <button class="btn  red" data-remove="/servers/remove/{{ $id }}"><i class="fa fa-trash"></i> Remove Server</button>
</div>
@endif

@endsection
