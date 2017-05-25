@extends('layouts.signin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Hello</div>

                <div class="panel-body">
                    We glad to see you at our website

                    @if (Auth::check())
                    <div class="text-center">
                        <a href="/logout" class="btn btn-default">Sign Out</a>
                    </div>
                    @else
                    <div class="text-center">
                        <a href="/login" class="btn btn-default">Sign In</a>
                        <a href="/register" class="btn btn-default">Sign Up</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
