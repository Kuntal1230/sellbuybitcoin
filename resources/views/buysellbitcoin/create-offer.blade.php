@extends('buysellbitcoin.partial.master') @section('content')
@guest
<section id="create-ad-heading" style="border-bottom: 1px solid #EEE;">
    <div class="content-wrap nopadding">
        <div class="container center clearfix">
            <div class="emphasis-title bottommargin-xs topmargin-xs">
                <h1>Add Bitcoin Trade Offer</h1>
                <p class="lead">Mybitcoinbuysell lets you list your offer to buy or sell bitcoins.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3">
            <p class="lead">Your trade offer will be seen by entire Mybitcoinbuysell community.
                <a href="">Please register first.</a>
            </p>
        </div>
    </div>
    <br><br><hr>

    <div class="container clearfix">

        <div class="col_one_third">
            <div class="feature-box fbox-center fbox-dark fbox-plain">
                <div class="fbox-icon">
                    <i class="fa fa-eye fa-5x" style="color: #1E8BC3;"></i>
                </div>
                <h3>Trust and Reputation</h3>
                <p>Know who you are dealing with. Our feedback system is modeled after the best and has been proven by over
                    twenty years of market use. Trade safely.</p>
            </div>
        </div>

        <div class="col_one_third">
            <div class="feature-box fbox-center fbox-dark fbox-plain">
                <div class="fbox-icon">
                    <i class="fa fa-bar-chart fa-5x" aria-hidden="true" style="color: #1E8BC3;"></i>
                </div>
                <h3>Mediation</h3>
                <p>As a seller of bitcoins your safety is your responsibility. Our mediators will factor in a sellers reputation
                    and history when deciding on a dispute. Please protect yourself with proper KYC and be aware of the risks
                    of the payment methods you sell with.</p>
            </div>
        </div>

        <div class="col_one_third col_last">
            <div class="feature-box fbox-center fbox-dark fbox-plain">
                <div class="fbox-icon">
                    <i class="fa fa-shield fa-5x" aria-hidden="true" style="color: #1E8BC3;"></i>
                </div>
                <h3>Secure Escrow</h3>
                <p>Our escrow system protects buyers of bitcoin by holding the sellers bitcoins in secure escrow. When payment
                    is completed the bitcoins are released to the buyers wallet.</p>
            </div>
        </div>

    </div>
</section>

@else
<section id="create-ad-heading" style="border-bottom: 1px solid #EEE;">
    <div class="content-wrap nopadding">
        <div class="container center clearfix">
            <div class="emphasis-title bottommargin-xs topmargin-xs">
                <h1>Add Bitcoin Trade Offer</h1>
                <p class="lead">Mybitcoinbuysell lets you list your offer to buy or sell bitcoins.</p>
            </div>
        </div>
    </div>
</section>

<section id="create-ad-content" class="darker-bg toppadding">
    <div class="container clearfix">
        <div class="row">
            <div class="col-sm-offset-3 col-sm-9">
            </div>
        </div>
        @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif

        <form method="POST" action="{{ route('user.offersave') }}" accept-charset="UTF-8" role="form" id="new-offer-form" class="ad-form form-lg nobottommargin bv-form" data-new-offer="1" novalidate="novalidate">
        {{ csrf_field() }}
            <div class="form-process"></div>

            <div class="row row-table bottommargin-sm">
                <div class="col-sm-3 new-offer-label col-middle">
                    <h4 class="light-title nobottommargin">I Want To</h4>
                </div>
                <div class="col-sm-9 col-middle fieldset-offer-type">
                    <div class="offer-property-type-group offer-type-group {{ $errors->has('type') ? ' has-error' : '' }}">
                            <label>
                                <input type="radio" name="type" value="buy"/>
                                <div class="buy-btc box">
                                  <span></span> <label>Buy Bitcoin</label>
                                </div>
                              </label>

                                <label>
                                <input type="radio" name="type" value="sell"/>
                                <div class="sell-btc box">
                                  <span></span> <label>Sell Bitcoin</label>
                                </div>
                              </label>
                              @if ($errors->has('type'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('type') }}</strong>
                              </span>
                          @endif
                    </div>
                </div>
            </div>

            <div class="row row-table bottommargin-sm">
                <div class="col-sm-3 new-offer-label col-middle">
                    <h4 class="light-title nobottommargin">Choose Currency</h4>
                </div>
                <div class="col-sm-9 col-middle">
                    <div class="form-group{{ $errors->has('currency') ? ' has-error' : '' }} ">
                        <label for="currency" class="control-label sr-only">Currency</label>
                        <select name="currency" class="form-control select2" data-placeholder="Select your currency" id="currency">
                                <option value="">Select your currency</option>
                            @foreach ($countries as $country)
                                <option data-currencycode="{{ $country->currency_code }}" value="{{ $country->id }}">{{ $country->currency_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('currency'))
                        <span class="help-block">
                            <strong>{{ $errors->first('currency') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="row row-table">
                <div class="col-sm-3 new-offer-label col-middle">
                    <h4 class="light-title nobottommargin">Payment Method</h4>
                </div>
                <div class="col-sm-9 col-middle">
                    <div class="form-group{{ $errors->has('payment_method') ? ' has-error' : '' }} ">
                        <label for="payment_method_id" class="sr-only">Payment Method</label>
                        <select name="payment_method" class="form-control" data-placeholder="Select your Payment method" id="paymentmethod">
                            <option value="">Select your Payment method</option>
                                @foreach ($paymentmethods as $paymentmethod)
                                    <option value="{{ $paymentmethod->id }}">{{ $paymentmethod->name }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('payment_method'))
                            <span class="help-block">
                                <strong>{{ $errors->first('payment_method') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row bottommargin-sm">
                <div class="col-sm-offset-3 col-sm-9">
                    <div class="help-block nomargin">
                        <span class="text-muted">Some of available payment methods </span>
                        <a href="#" class="payment-method-recommendation" data-group-id="2" data-payment-id="194" data-payment-window="1440">Cash In Person</a>,
                        <a href="#" class="payment-method-recommendation" data-group-id="2" data-payment-id="1" data-payment-window="180">Western Union</a>,
                        <a href="#" class="payment-method-recommendation" data-group-id="1" data-payment-id="4" data-payment-window="90">Amazon Gift Card</a>
                        <div class="pull-right">
                            <a class="pull-left" target="_blank" href="">View all payment methods</a>
                        </div>
                        <p id="new_payment_method_notice" class="nomargin" style="display: block;">
                            Please search for and use existing payment methods.Creating a new or custom payment method will delay your offer from being
                            seen until the payment method is approved. Do not add custom information like "instant release"
                            or other promotional content to payment method names, they will be deleted and a standard payment
                            method will be assigned to your offer by a moderator.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row row-table bottommargin-sm">
                <div class="col-sm-3 new-offer-label col-middle">
                    <h4 class="light-title nobottommargin">
                        Payment Method Label
                        <i class="icon-line2-question" data-toggle="popover" data-placement="bottom" data-content="Any marketing text like 'INSTANT RELEASE' or 'NO RECEIPT REQUIRED' that will appear after your payment method. Maximum 25 characters and only letters and numbers."
                            data-container="body" data-trigger="hover" data-original-title="" title=""></i>
                    </h4>
                </div>
                <div class="col-sm-9 col-middle">
                    <div class="form-group ">
                        <label for="payment_method_label" class="sr-only">Payment Method Label</label>
                        <input id="payment_method_label" placeholder="Optionally add label next to your payment method in listings" class="form-control input-lg"
                            name="payment_method_label" type="text" data-bv-field="payment_method_label">
                        <small class="help-block" data-bv-validator="stringLength" data-bv-for="payment_method_label" data-bv-result="NOT_VALIDATED"
                            style="display: block;">Payment custom marketing text must be less than 25 characters</small>
                    </div>
                </div>
            </div>
            <div class="row row-table bottommargin-sm">
                <div class="col-sm-3 new-offer-label col-middle">
                    <h4 class="light-title nobottommargin">Country
                        <i class="icon-line2-question" data-toggle="popover" data-placement="bottom" data-content="Determines country flag on the offer. Ideal if your payment method is meant for specific country. Leave empty not to show flag."
                            data-container="body" data-trigger="hover" data-original-title="" title=""></i>
                    </h4>
                </div>
                <div class="col-sm-9 col-middle">
                    <div class="form-group{{ $errors->has('offer_country') ? ' has-error' : '' }} ">
                        <label for="offer_country" class="sr-only">Offer country</label>
                        <select class="form-control input-lg select2" id="offer_country" placeholder="" name="offer_country">
                            <option value="" selected="selected">Select your country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('offer_country'))
                            <span class="help-block">
                                <strong>{{ $errors->first('offer_country') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>


            <div class="row row-table">
                <div class="col-sm-3 new-offer-label col-middle">
                    <h4 class="light-title nobottommargin">Price Markup</h4>
                </div>
                <div class="col-sm-9 col-middle">
                    <div class="form-group{{ $errors->has('margin') ? ' has-error' : '' }} ">
                        <div class="input-group" style="max-width: 150px; float: left;">
                            <label for="margin" class="sr-only">Markup</label>
                            <input id="margin" max="21000" step="0.01" class="form-control input-lg" placeholder="0" name="margin" type="number" data-bv-field="margin">
                            <span class="theme-border-radius input-group-addon">%</span>

                        </div>
                        <div style="margin-left: 180px; position: relative;">
                            <img src="{{ asset('images/preloader.gif') }}" style="position: absolute;left: -30px;top: 3px; display: none;" id="currency-preloader-img"
                                alt="Currency switching loading animation">
                            <h4 id="btc-current-market-price-wrapper" class="nobottommargin">
                                <input id="offer_price" type="hidden" name="offer_price" value="">
                                <span id="btc-current-market-price" data-zero-margin-price="" class="heading-color"></span>
                                <span id="fiat-current-currency" class="heading-color">{{ $current_info->currency_code }}</span> / BTC

                            </h4>
                            <span class="text-muted">Offer price</span>
                        </div>
                        <small class="help-block" data-bv-validator="notEmpty" data-bv-for="margin" data-bv-result="NOT_VALIDATED" style="display: block;">Please set your margin</small>
                        <small class="help-block" data-bv-validator="numeric" data-bv-for="margin" data-bv-result="NOT_VALIDATED" style="display: block;">Margin must be numeric</small>
                        <small class="help-block" data-bv-validator="lessThan" data-bv-for="margin" data-bv-result="NOT_VALIDATED" style="display: block;">Please enter a value less than or equal to %s</small>
                        @if ($errors->has('margin'))
                            <span class="help-block">
                                <strong>{{ $errors->first('margin') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row bottommargin-sm topmargin-xs">
                <div class="col-sm-offset-3 col-sm-9">
                    <span class="text-muted">Initial bitcoin price is
                        <strong>ask</strong> average of 3 exchanges: Bitstamp, Bitfinex &amp; Coinbase.</span>
                </div>
            </div>

            <div class="row bottommargin-xs" id="minmax-amount-row">
                <div class="col-sm-3 new-offer-label">
                    <h4 class="light-title nobottommargin">Set Minimum &amp; Maximum Amount</h4>
                </div>
                <div class="col-sm-9" id="minmax-amount-cont">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="amount_range" class="sr-only">Amount Range</label>
                            <input id="amount_range" name="amount_range" type="text" class="irs-hidden-input" style="visibility:hidden;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="divider divider-center divider-contrast">OR</div>
                        </div>
                    </div>
                    <div class="price-range-wrapper row">
                        <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('range_min') ? ' has-error' : '' }}">
                                <div class="input-group">
                                    <label for="range_min" class="sr-only">Range Min</label>
                                    <span class="theme-border-radius input-group-addon">Min</span>
                                    <input id="range_min" step="1" type="text" class="form-control input-lg" name="range_min" value="" data-bv-field="range_min">
                                    <span class="theme-border-radius input-group-addon currency-addon">USD</span>
                                </div>
                                <small class="help-block" data-bv-validator="notEmpty" data-bv-for="range_min" data-bv-result="NOT_VALIDATED" style="display: none;">Please set minimum amount</small>
                                <small class="help-block" data-bv-validator="numeric" data-bv-for="range_min" data-bv-result="NOT_VALIDATED" style="display: none;">Amount must be numeric</small>
                                @if ($errors->has('range_min'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('range_min') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('range_max') ? ' has-error' : '' }}">
                                <div class="input-group">
                                    <label for="range_max" class="sr-only">Range Max</label>
                                    <span class="theme-border-radius input-group-addon">Max</span>
                                    <input id="range_max" step="1" type="text" class="form-control input-lg" name="range_max" data-bv-field="range_max">
                                    <span class="theme-border-radius input-group-addon currency-addon">USD</span>
                                </div>
                                <small class="help-block" data-bv-validator="notEmpty" data-bv-for="range_max" data-bv-result="NOT_VALIDATED" style="display: none;">Please set maximum amount</small>
                                <small class="help-block" data-bv-validator="numeric" data-bv-for="range_max" data-bv-result="NOT_VALIDATED" style="display: none;">Amount must be numeric</small>
                                @if ($errors->has('range_max'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('range_max') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-table bottommargin-sm">
                <div class="col-sm-3 col-middle new-offer-label">
                    <h4 class="light-title nobottommargin">
                        Payment Window
                        <i class="icon-line2-question" data-toggle="popover" data-placement="bottom" data-content="How much time person interested in your offer has time to actually pay. Trade will auto-cancel if buyer has not clicked 'marked as paid' before payment window expires."
                            data-container="body" data-trigger="hover" data-original-title="" title=""></i>
                    </h4>
                </div>
                <div class="col-middle col-sm-9">
                    <div class="form-group  pull-left{{ $errors->has('payment_window') ? ' has-error' : '' }}">
                        <div class="input-group" style="max-width: 180px;">
                            <label for="payment_window" class="sr-only">Payment Window</label>
                            <input id="payment_window" max="10000" step="1" class="form-control input-lg" placeholder="0" name="payment_window" type="number"
                                data-bv-field="payment_window">
                            <span class="theme-border-radius input-group-addon">minutes</span>
                        </div>
                        <small class="help-block" data-bv-validator="notEmpty" data-bv-for="payment_window" data-bv-result="NOT_VALIDATED" style="display: block;">Please set payment window</small>
                        <small class="help-block" data-bv-validator="numeric" data-bv-for="payment_window" data-bv-result="NOT_VALIDATED" style="display: block;">Payment window limit must be number</small>
                        <small class="help-block" data-bv-validator="integer" data-bv-for="payment_window" data-bv-result="NOT_VALIDATED" style="display: block;">Please enter a valid number</small>
                        <small class="help-block" data-bv-validator="lessThan" data-bv-for="payment_window" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a value less than or equal to %s</small>
                        @if ($errors->has('payment_window'))
                            <span class="help-block">
                                <strong>{{ $errors->first('payment_window') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div style="display: none;" class="payment-window-suggestion pull-left leftmargin-sm topmargin-xs text-muted">Most used payment window for
                        <strong>
                            <span id="chosen-payment-method">x</span>
                        </strong> is
                        <strong>
                            <span id="most-used-payment-window">n</span>
                        </strong> minutes</div>
                </div>
            </div>

            <div class="row bottommargin-sm">
                <div class="col-sm-3 new-offer-label">
                    <h4 class="light-title nobottommargin">
                        Offer Terms
                        <i class="icon-line2-question" data-toggle="popover" data-placement="bottom" data-content="Shown publicly on your offer listing. Offer terms must tell the user what to expect clearly, such as a cash receipt or to go to a bank branch in person or to go to an external web site. There should not be enough information to complete a trade only enough to let them know what to expect."
                            data-container="body" data-trigger="hover" data-original-title="" title=""></i>
                    </h4>
                </div>
                <div class="col-sm-9">
                    <div class="form-group{{ $errors->has('offer_terms') ? ' has-error' : '' }} ">
                        <textarea rows="4" style="width: 100%;" id="offer_terms" name="offer_terms" cols="50"></textarea>
                        @if ($errors->has('offer_terms'))
                            <span class="help-block">
                                <strong>{{ $errors->first('offer_terms') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row row-table bottommargin-sm">
                <div class="col-sm-3 new-offer-label">
                    <h4 class="light-title nobottommargin">
                        Offer terms tags
                        <i class="icon-line2-question" data-toggle="popover" data-placement="bottom" data-content="Add quick tags that describe your offer terms such as &quot;No ID needed&quot;, &quot;No receipt needed&quot;. Tags like &quot;Great price&quot; or similar are not accepted because are not describing the terms."
                            data-container="body" data-trigger="hover" data-original-title="" title=""></i>
                    </h4>
                </div>
                <div class="col-sm-9">
                    <div class="form-group  tag-control">
                        <select class="form-control" name="tags[]"multiple="multiple">
                            <option >verified paypal only</option>
                            <option>photo id required</option>
                            <option>cash only</option>
                            <option>online payments </option>
                            <option>no id needed</option>
                            <option>no verification needed</option>
                            <option>no receipt needed</option>
                            <option>physical cards only</option>
                            <option>e-codes accepted</option>
                            <option>receipt required</option>
                          </select>
                        <div class="pull-left">Maximum 3 tags</div>
                        <div class="pull-right">Your desired tag is missing?
                            <a href="#" data-target="#addTagModal" data-toggle="modal">Suggest new</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row bottommargin-sm">
                <div class="col-sm-3 new-offer-label">
                    <h4 class="light-title nobottommargin">
                        Trade Instructions
                        <i class="icon-line2-question" data-toggle="popover" data-placement="bottom" data-content="Shown once the trade has started. Trade instructions must be short, clear and bulleted if possible. Step by step clear action items are required. Keep the length text at the bottom."
                            data-container="body" data-trigger="hover" data-original-title="" title=""></i>
                    </h4>
                </div>
                <div class="col-sm-9">
                    <div class="form-group{{ $errors->has('trade_details') ? ' has-error' : '' }} ">
                        <textarea rows="4" style="width: 100%;" id="trade_details" name="trade_details" cols="50"></textarea>
                        @if ($errors->has('trade_details'))
                            <span class="help-block">
                                <strong>{{ $errors->first('trade_details') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row bottommargin-sm">

                <div class="col-sm-9 col-sm-offset-3">
                    <a class="collapsible-panel collapsed" role="button" data-toggle="collapse" href="#advancedSettingsPanel" aria-expanded="false"
                        aria-controls="advancedSettingsPanel">
                        <i class="fa fa-arrow-circle-down"></i> Advanced settings</a>
                </div>
                <div class="collapse" id="advancedSettingsPanel">

                    <div class="row-table bottommargin-sm">
                        <div class="col-sm-3 new-offer-label">
                            <h4 class="light-title nobottommargin">Verified</h4>
                        </div>
                        <div class="col-sm-9">
                            <div class="checkbox notopmargin">
                                <input name="require_verified_email" type="hidden" value="0">
                                <label>
                                    <input name="require_verified_email" type="checkbox" value="1"> Require that trade partner has verified their email
                                </label>
                            </div>
                            <div class="checkbox notopmargin">
                                <input name="require_verified_phone" type="hidden" value="0">
                                <label>
                                    <input name="require_verified_phone" type="checkbox" value="1"> Require that trade partner has verified their phone
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row-table bottommargin-sm">
                        <div class="col-sm-3 new-offer-label">
                            <h4 class="light-title nobottommargin">Offer visibility</h4>
                        </div>
                        <div class="col-sm-9">
                            <div class="checkbox notopmargin">
                                <input name="show_only_trusted_user" type="hidden" value="0">
                                <label>
                                    <input name="show_only_trusted_user" type="checkbox" value="1"> Show offer only to trusted users
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row-table bottommargin-sm">
                        <div class="col-sm-3 new-offer-label col-middle">
                            <h4 class="light-title nobottommargin">Require minimum
                                <i class="icon-line2-question" data-toggle="popover" data-placement="bottom" data-content="Set how many successful trades your partner needs to have to start a trade with you."
                                    data-container="body" data-trigger="hover" data-original-title="" title=""></i>
                            </h4>
                        </div>
                        <div class="col-sm-9 col-middle">
                            <div class="form-group  has-feedback">
                                <div class="input-group" style="max-width: 230px;">
                                    <label for="require_min_past_trades" class="sr-only">Min Past Trades</label>
                                    <input id="require_min_past_trades" min="0" step="1" class="form-control input-lg" placeholder="0" name="require_min_past_trades"
                                        type="number" data-bv-field="require_min_past_trades">
                                    <span class="theme-border-radius input-group-addon">past trades</span>
                                </div>
                                <i class="form-control-feedback bv-icon-input-group" data-bv-icon-for="require_min_past_trades" style="display: none;"></i>
                                <small class="help-block" data-bv-validator="greaterThan" data-bv-for="require_min_past_trades" data-bv-result="NOT_VALIDATED"
                                    style="display: none;">Please enter a value greater than or equal to %s</small>
                                <small class="help-block" data-bv-validator="integer" data-bv-for="require_min_past_trades" data-bv-result="NOT_VALIDATED"
                                    style="display: none;">Please enter a valid number</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sell-offer-warning-notification row bottommargin-sm" style="display: block;">
                <div class="col-sm-offset-3 col-sm-9">
                    <div class="style-msg infomsg">
                        <div class="sb-msg">
                            <i class="icon-info-sign"></i> By creating sell offer you take responsibility and all risks related to selling bitcoin
                            online. We are not liable for any losses you may incur due to fraud and you agree not to hold
                            us responsible for any losses. We will work to provide you with any information you may need
                            to recover losses if they should occur.
                            <br> Please read our
                            <a target="_blank" href="http://blog.paxful.com/bitcoin-seller-scam-protection-guide-7-tips/">Bitcoin Seller Scam Defense Guide</a>
                            We have a Slack channel with pro-traders, ask us for invite and you will get in. Also check our
                            <a target="_blank" href="https://talk.paxful.com/">forum</a> for discussions.
                        </div>
                    </div>
                    <h4 class="nomargin">Paxful selling rules</h4>
                    <ul class="iconlist">
                        <li>
                            <i class="icon-arrow-right"></i> Trades outside escrow are strictly prohibited and will result in a permanent ban.</li>
                        <li>
                            <i class="icon-arrow-right"></i> No brokering is allowed.</li>
                        <li>
                            <i class="icon-arrow-right"></i> Clear offer terms and trade instructions. Check details under their question marks.
                            <strong>Not including proper terms or instructions will result in losing the trade dispute.</strong>
                        </li>
                        <li>
                            <i class="icon-arrow-right"></i> Scamming and frauds are against the rules and will lead to bitcoin seizure and potential
                            criminal investigation.</li>
                    </ul>
                    <h4 class="nomargin">
                        <strong style="color: red;">PAY ATTENTION!!!</strong> Your
                        <strong>bitcoins can be stolen</strong> when selling, read below!</h4>
                    <ul class="iconlist">
                        <li>
                            <i class="icon-arrow-right"></i> Always receive payment first and never release bitcoins to buyer before that.</li>
                        <li>
                            <i class="icon-arrow-right"></i> Never enter your Paxful account details outside
                            <strong>paxful.com</strong> such as fake Paxful verification websites etc. Paxful will never ask you
                            for account details.</li>
                        <li>
                            <i class="icon-arrow-right"></i> Never give your Paxful email to buyer because they will send phishing/warning email pretending
                            to be from Paxful email info@paxful.com because email can be easily spoofed.</li>
                        <li>
                            <i class="icon-arrow-right"></i> Don't give out your Google 6 digit code as scammer will try to reset your email password
                            and will access your Paxful account.</li>
                        <li>
                            <i class="icon-arrow-right"></i> Avoid and report phishing websites, always check that you are on
                            <strong>paxful.com</strong>.</li>
                        <li>
                            <i class="icon-arrow-right"></i> Always redeem gift cards first before releasing bitcoins to buyer.</li>
                        <li>
                            <i class="icon-arrow-right"></i> Paxful employees are not allowed to trade using Paxful name/brand so never trust if somebody
                            starts a trade with you pretending they work for Paxful.</li>
                    </ul>
                </div>
            </div>

            <div class="row bottommargin-sm">
                <div class="col-sm-offset-3 col-sm-9">
                    <button id="save-btn" class="btn ladda-button btn-lg btn-primary btn-block" data-style="zoom-in" type="submit">
                        <span class="ladda-label">Create offer</span>
                        <span class="ladda-spinner"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div id="addTagModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h3 class="modal-title">Suggest a tag</h3>
                </div>
                <form method="POST" action="https://paxful.com/offer-manager/suggest-tag" accept-charset="UTF-8" id="suggest-tag-form" class="nobottommargin form form-horizontal">
                    <input name="_token" type="hidden" value="p0nqyYycah93utAwR9CSt5lBPOAkDqGXDAihndyQ">
                    <div class="modal-body default-body">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <span class="help-block">Suggest any new tag that is describing your offer terms, such as "No ID needed", "No receipt
                                    needed" or similar. Tags such as "Great price", "Only today" are not descriptive of the
                                    offer terms.</span>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="control-label col-md-3" for="add-tag-field">
                                Tag
                            </label>
                            <div class="col-md-9">
                                <input type="text" placeholder="Tag name" class="form-control" name="tag[name]" id="add-tag-field">
                                <span class="help-block-error" data-attribute="name"></span>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="add-tag-description" class="control-label col-md-3">
                                Description
                            </label>
                            <div class="col-md-9">
                                <textarea class="form-control" placeholder="Short description of the tag" name="tag[description]" id="add-tag-description"></textarea>
                                <span class="help-block-error" data-attribute="description"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body success-body text-center text-success" style="font-size: 3em; display: none">
                        <i class="fa fa-check-circle-o"></i>
                        Suggestion sent! Paxful team will review the tag and you will get notified once it's confirmed or rejected.
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary ladda-button" data-style="zoom-in">
                            <span class="ladda-label"></span>Suggest
                            <span class="ladda-spinner"></span>
                        </button>
                        <button type="button" class="btn btn-info pull-left" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="suggestPaymentMethodModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h3 class="modal-title">Suggest new payment method</h3>
                </div>
                <form method="POST" action="" accept-charset="UTF-8" id="suggest-payment-method-form" class="nobottommargin form form-horizontal">

                    <div class="modal-body default-body">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <span class="help-block">Suggest a new payment method. Make sure that such payment method doesn't exist yet because
                                    most of the times payment method exists in our system. After submitting new payment method
                                    you will get notified once it's declined or approved by one of Paxful team members.</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <div class="error-summary alert alert-danger" style="display: none;"></div>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="control-label col-md-3" for="add-pm-field">
                                Name
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="paymentMethod[name]" id="add-pm-field">
                                <span class="help-block-error" data-attribute="name"></span>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="pm-group-id" class="control-label col-md-3">
                                Group
                            </label>
                            <div class="col-md-9">
                                <select class="form-control" id="pm-group-id" name="paymentMethod[payment_method_group_id]">
                                    <option value="" selected="selected">-</option>
                                    <option value="1">Gift cards</option>
                                    <option value="2">Cash deposits</option>
                                    <option value="3">Online transfers</option>
                                    <option value="4">Debit/credit cards</option>
                                </select>
                                <span class="help-block-error" data-attribute="payment_method_group_id"></span>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="add-pm-description-short" class="control-label col-md-3">
                                Short description
                            </label>
                            <div class="col-md-9">
                                <textarea rows="3" class="form-control" name="paymentMethod[description_short]" maxlength="100" id="add-pm-description-short"></textarea>
                                <span class="help-block pull-right">Characters left
                                    <span id="pm-description-short-counter">100</span>
                                </span>
                                <span class="help-block">What is the payment method about? Please be as precise as possible, this will appear offers
                                    listings page.</span>
                                <span class="help-block-error" data-attribute="description_short"></span>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="add-pm-description-long" class="control-label col-md-3">
                                Long description
                            </label>
                            <div class="col-md-9">
                                <textarea rows="6" class="form-control" name="paymentMethod[description_long]" id="add-pm-description-long"></textarea>
                                <span class="help-block">Longer description that will appear on how-to page of that payment method.</span>
                                <span class="help-block-error" data-attribute="description_long"></span>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="add-pm-instructions" class="control-label col-md-3">
                                Instructions
                                <i class="icon-line2-question" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Instructions how to use the payment method"
                                    data-trigger="hover" data-original-title="" title=""></i>
                            </label>
                            <div class="col-md-9">
                                <textarea rows="6" class="form-control" name="paymentMethod[instructions]" id="add-pm-instructions"></textarea>
                                <span class="help-block">Instructions about how to make payment. For example in gift cards case where to acquire gift
                                    card and what gift card details need to be sent to bitcoin vendor.</span>
                                <span class="help-block-error" data-attribute="instructions"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body success-body text-center text-success" style="font-size: 3em; display: none">
                        <i class="fa fa-check-circle-o"></i>
                        Suggestion sent! Paxful team will review the payment method and you will get notified once it's confirmed or rejected.
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary ladda-button" data-style="zoom-in">
                            <span class="ladda-label">
                                <i class="fa fa-check"></i> Suggest</span>
                            <span class="ladda-spinner"></span>
                        </button>
                        <button type="button" class="btn btn-info pull-left" data-dismiss="modal">
                            <i class="fa fa-close"></i> Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container clearfix">

        <div class="col_one_third">
            <div class="feature-box fbox-center fbox-dark fbox-plain">
                <div class="fbox-icon">
                    <i class="fa fa-eye fa-5x" style="color: #1E8BC3;"></i>
                </div>
                <h3>Trust and Reputation</h3>
                <p>Know who you are dealing with. Our feedback system is modeled after the best and has been proven by over
                    twenty years of market use. Trade safely.</p>
            </div>
        </div>

        <div class="col_one_third">
            <div class="feature-box fbox-center fbox-dark fbox-plain">
                <div class="fbox-icon">
                    <i class="fa fa-bar-chart fa-5x" aria-hidden="true" style="color: #1E8BC3;"></i>
                </div>
                <h3>Mediation</h3>
                <p>As a seller of bitcoins your safety is your responsibility. Our mediators will factor in a sellers reputation
                    and history when deciding on a dispute. Please protect yourself with proper KYC and be aware of the risks
                    of the payment methods you sell with.</p>
            </div>
        </div>

        <div class="col_one_third col_last">
            <div class="feature-box fbox-center fbox-dark fbox-plain">
                <div class="fbox-icon">
                    <i class="fa fa-shield fa-5x" aria-hidden="true" style="color: #1E8BC3;"></i>
                </div>
                <h3>Secure Escrow</h3>
                <p>Our escrow system protects buyers of bitcoin by holding the sellers bitcoins in secure escrow. When payment
                    is completed the bitcoins are released to the buyers wallet.</p>
            </div>
        </div>

    </div>
</section>
@endguest
@endsection

@section('pagejs')
    <script>
     // initialze select2 content
     $('select').select2({
       tags: true,
       tokenSeparators: [',', ' '],
       maximumSelectionLength: 3
    });
    </script>
@endsection
