@extends('layouts.signin')

<!-- Main Content -->
@section('content')
<!-- BEGIN FORGOT PASSWORD -->
<div class="content">
    @if (session('status'))
        <div class="text-center">
            The activation link was sent to your email
        </div>
    @else
        <!-- BEGIN FORGOT PASSWORD FORM -->
        <form action="{{ url('/password/email') }}" method="post">
            {{ csrf_field() }}

            <h3 class="font-green">Forget Password ?</h3>
            <p> Enter your e-mail address below to reset your password. </p>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" value="{{ old('email') }}" />

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success uppercase">Submit</button>
                <a href="{{ url('/') }}" class="forget-password">Back to Log In</a>
            </div>
        </form>
        <!-- END FORGOT PASSWORD FORM -->
    @endif
</div>
<!-- END FORGOT PASSWORD -->
@endsection
