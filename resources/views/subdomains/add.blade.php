@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>Add New Subdomain</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/dashboard">Dashboard</a>
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

                        <div class="text-right">
                            <button type="submit" class="btn green">{{ ! empty($id) ? 'Save' : 'Add' }} Subdomain</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
