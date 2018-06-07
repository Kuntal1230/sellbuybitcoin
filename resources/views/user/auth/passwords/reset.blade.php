@extends('buysellbitcoin.partial.master') 

@section('content')
<section id="content">
    <div class="content-wrap nopadding">
        <div class="section notopborder nomargin">
            <div class="container clearfix">
                <div class="col-sm-6 col-sm-offset-3">
                    <h1 class="text-center nomargin">Submit your new password</h1>
                    <div class="row">
                        <div class="col-xs-12">
                            <form method="POST" action="{{ route('password.request') }}" accept-charset="UTF-8" role="form" id="loginForm">
                                {{ csrf_field() }}
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="login_email" class="sr-only">Email</label>
                                    <input class="form-control input-lg" id="login_email" placeholder="Email" type="email" name="email" value="{{ $email or old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="login_password" class="sr-only">Password</label>
                                    <input class="form-control input-lg" id="login_password" placeholder="Password" required="required" name="password"
                                        type="password" value="">
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                </div>

                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="login_password" class="sr-only">Confirm Password</label>
                                    <input class="form-control input-lg" id="login_password" placeholder="Password" type="password" name="password_confirmation" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <button class="btn btn-lg btn-primary btn-block ladda-button bottommargin-sm" data-style="zoom-in" type="submit">
                                    <span class="ladda-label">Reset Password</span>
                                    <span class="ladda-spinner"></span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection