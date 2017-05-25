@extends('layouts.signin')

@section('content')
<!-- BEGIN FORGOT PASSWORD -->
<div class="content">
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form action="{{ url('/password/reset') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">

        <h3 class="font-green">Reset Password</h3>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <input class="form-control placeholder-no-fix" type="email" placeholder="Email" name="email" value="{{ $email or old('email') }}" />

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control placeholder-no-fix" type="password" placeholder="Password" name="password" />

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">Confirm Password</label>
            <input class="form-control placeholder-no-fix" type="password" placeholder="Confirm Password" name="password_confirmation" />

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-actions text-center">
            <button type="submit" class="btn btn-success uppercase">Reset Password</button>
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
</div>
<!-- END FORGOT PASSWORD -->
@endsection
