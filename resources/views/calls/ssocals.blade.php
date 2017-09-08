@extends('layouts.app')
@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>SSO Calls</h1>
    <ol class="breadcrumb">
        <li>
            <a href="/">Dashboard</a>
        </li>
        <li class="active">SSO Calls</li>
    </ol>
</div>
@endsection
@section('content')
    <div class="portlet box blue-madison">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i> SSO Calls </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="panel-group accordion scrollable" id="accordion2">
                @foreach($calls as $call)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_{{$call['number']}}" aria-expanded="false"> {{$call['name']}} </a>
                            </h4>
                        </div>
                        <div id="collapse_2_{{$call['number']}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <div class="portlet-body form">
                                    <div class="col-md-4">
                                        <form class="form-horizontal sso-send-form" id="{{$call['id']}}" role="form">
                                            {{ csrf_field() }}
                                            @foreach($call['fields'] as $item)
                                            <div class="form-group">
                                                <label for="{{$item}}" class="col-md-4 control-label">{{$item}}</label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" id="{{$item}}" name="{{$item}}" placeholder="{{$item}}"> 
                                                </div>
                                            </div>
                                            @endforeach
                                            <span class="label label-sm label-success success hidden">Success</span>
                                            <span class="label label-sm label-danger error hidden">Error</span>
                                        </form>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Result</label>
                                            <textarea class="form-control" id="{{$call['id']}}" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="col-md-offset-2 col-md-10">
                                                <button type="button" class="btn blue sso-send" data-form-id="{{$call['id']}}" data-method="{{$call['method']}}">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
