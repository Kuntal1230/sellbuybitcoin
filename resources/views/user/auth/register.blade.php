@extends('buysellbitcoin.partial.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default register-panel">
                <div class="panel-heading"><h3>First create an account</h3></div>

                <div class="panel-body">
                    <form class="form-horizontal register-form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">CHOOSE YOUR USERNAME</label>

                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Type your username" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">EMAIL</label>

                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Your email" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">PASSWORD</label>
                                <input id="password" type="password" class="form-control" name="password" placeholder="Choose password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="control-label">REPEAT YOUR PASSWORD</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required>
                            
                        </div>
                        <ul class="list-unstyled" style="font-size: 0.9em;">
                            <li>Tips:</li>
                            <li><b>Make the password at least 8 characters long.</b> The longer the better. Longer passwords are harder for thieves to crack.</li>
                            <li><b>Include numbers, capital letters and symbols. </b> Consider using a $ instead of an S or a 1 instead of an L, or including an &amp; or % – but note that $1ngle is NOT a good password. Password thieves are onto this. But Mf$J1ravng (short for “My friend Sam Jones is really a very nice guy) is an excellent password.</li>
                        </ul>

                        <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary btn-block ladda-button">
                                    Register
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
