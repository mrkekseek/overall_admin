@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>Import Members</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/dashboard">Dashboard</a>
        </li>
        <li>
            <a href="/federations/lists">Federations List</a>
        </li>
        <li class="active">Import Members</li>
    </ol>
</div>
@endsection

@section('content')
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
@endsection
