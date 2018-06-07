@extends('buysellbitcoin.partial.master') 

@section('content')
<section id="content">
    <div class="content-wrap nopadding">
        <div class="section notopborder nomargin">
            <div class="container clearfix">
                <div class="col-sm-6 col-sm-offset-3">
                    <h1 class="text-center nomargin">Forgot password</h1>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="promo promo-border vertical-padding container-padding bottommargin-sm topmargin-xs">
                                <p class="nomargin text-muted">Enter your email address to request a password reset. You will receive an email containing password reset instructions.</p>
                            </div>
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('password.email') }}" accept-charset="UTF-8" role="form" id="loginForm">
                                {{ csrf_field() }}
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="login_email" class="sr-only">Email</label>
                                    <input class="form-control input-lg" id="login_email" placeholder="Email" type="email" name="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>                               
                                <div class="row bottommargin-xs">
                                    <div class="col-sm-12">
                                        {{-- <div id="g-recaptcha-HB3zpY" class="recaptcha" data-sitekey="6Ld06AcTAAAAAASfSRekSr5A1HZJuIdrfeQZJP62">
                                            <div style="width: 304px; height: 78px;">
                                                <div>
                                                    <iframe src="https://www.google.com/recaptcha/api2/anchor?k=6Ld06AcTAAAAAASfSRekSr5A1HZJuIdrfeQZJP62&amp;co=aHR0cHM6Ly9wYXhmdWwuY29tOjQ0Mw..&amp;hl=en&amp;v=v1523554879111&amp;size=normal&amp;cb=hmgbpunvk5ga"
                                                        width="304" height="78" role="presentation" frameborder="0" scrolling="no"
                                                        sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe>
                                                </div>
                                                <textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response"
                                                    style="width: 250px; height: 40px; border: 1px solid #c1c1c1; margin: 10px 25px; padding: 0px; resize: none;  display: none; "></textarea>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>

                                <button class="btn btn-lg btn-primary btn-block ladda-button bottommargin-sm" data-style="zoom-in" type="submit">
                                    <span class="ladda-label">Request password</span>
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