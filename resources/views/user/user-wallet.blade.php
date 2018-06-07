@extends('buysellbitcoin.partial.master')


@section('content')
<!--Active design start hear-->
<div class="container-fluid wallet_fluid">
    <div class="container">
        <div class="wallet_D">
            <div class="col-lg-9 col-md-9 col-xs-12 wallet_col">
                <div class="wallet_current">
                    <div class="current">
                        <h3 class="current_h3">Current Balance</h3>
                        <h4 class="current_h4">
                            <span  class="current_span"> <span id="curr_balance">{{ bcdiv($walletinfo->balance,'100000000',8) }}</span>  BTC </span> ≈ <span id="curr_local_balance" class="font-size-26"></span> <span id="curr_currency" class="font-size-26">{{ $current_info->currency_code }}</span> </h4>
                        <a class="current_a1" href="#">Add money</a>
                    </div>
                    <div class="current_p_div">
                        <p class="current_p">The worth of your bitcoins in US dollars varies with the market just like gold. This is normal. You
                            still have the same amount of bitcoin.</p>
                    </div>
                    <div class="current_send_div">
                        <a class="current_send_a" href="#" data-toggle="modal" data-target="#senBitcoinModal">Send Bitcoin </a>
                    </div>
                </div>
            </div>
            <div class="bitcoin_master_address">
                <div class="col-lg-1 col-lg-offset-3 col-md-2 col-md-offset-2 col-sm-2 col-sm-offset-2 hidden-xs">
                    <a href="#" data-toggle="modal" data-target="#requestedBitcoinAddressModal">
                        <div class="pull-right none" data-toggle="modal" data-target="#exampleModalCenter">
                            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate($walletinfo->receiveAddress)) !!} ">
                        </div>
                    </a>
                </div>
                <div class="col-lg-8 col-md-8 col-xs-12">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="master_address">
                                <h3 class="address_h3">Your bitcoin deposit address is below
                                    <a href="">
                                        <i class="fa fa-question-circle"></i>
                                    </a>
                                    <span class="address_span">{{ $walletinfo->receiveAddress }}</span>
                                </h3>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                </div>
            </div>

            <div class="wallet_transactions">
                <div class="jj">
                    <div class="jj_col">
                        <div class="col-lg-6 col-md-6 col-xs-12 tran">Transactions</div>
                        <div class="col-lg-6 col-md-6 col-xs-12 addre">
                            <a class="addre_a" href="#">Addresses</a>
                        </div>
                    </div>
                    <div class="no">No transactions</div>
                    <div class="a_div">
                        <a class="all" href="#">All transactions</a>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<!--Active design end hear-->

@endsection

@section('modal')

<!--send bitcoin modal -->
<div class="modal fade in" id="senBitcoinModal" tabindex="-1" role="dialog" aria-labelledby="sendBitcoinModal" aria-hidden="false"
    style="display: none;">
    <div class="modal-backdrop fade in" style="height: 517px;"></div>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h3 class="modal-title">
                    <i class="icon-line2-paper-plane"></i> Send from wallet</h3>
            </div>
            <div class="modal-body">
                <div class="carousel slide" data-ride="carousel" data-interval="false" data-wrap="false" data-keyboard="false">
                    <div class="carousel-inner">
                        <div id="first_item" class="item  active ">
                            <form method="POST" action="" accept-charset="UTF-8" role="form" id="prepare-send-form"
                                class="form-horizontal nobottommargin" autocomplete="off">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="col-sm-offset-3 sendAvailableCryptoContainer">
                                        <h3 class="form-control-static col-sm-12">Available
                                            <span id="sendAvailable" style="cursor: pointer; color: #1ABC9C;" title="Click to set full amount to sendout" data-max-fiat="0.00"
                                                data-max-btc="0">{{ bcdiv($walletinfo->balance,'100000000',8) }}</span>
                                            <strong id="currencyType">BTC</strong>
                                        </h3>
                                    </div>
                                </div>
                                <div class="form-group form-group-lg">
                                    <label for="sendAmount" class="col-sm-3 control-label" style="padding-top: 3px;">
                                        <span class="label-currency-name">Bitcoin Amount</span>
                                    </label>
                                    <div class="col-sm-5">
                                        <div class="input-group">
                                            <input id="sendAmount" max="21000000" min="0.00000547" step="0.00000001" class="form-control" placeholder="0.000000"
                                                data-market-price="" name="btcAmount" type="number">
                                            <div class="input-group-addon input-currency-indicator">BTC</div>
                                        </div>
                                        <div id="amount_error" class="amount-error text-danger hidden">More than your balance amount was chosen</div>
                                    </div>
                                    <div class="col-sm-4 control-label tleft">
                                        <p class="text-muted">≈
                                            <span id="sendAmountFiat">0.00</span>
                                            <span id="sendCurrencyCode">{{ $current_info->currency_code }}</span>
                                            
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group form-group-lg">
                                    <label for="bitcoinaddr" class="col-sm-3 control-label">To bitcoin address</label>
                                    <div class="col-sm-9">
                                        <input id="bitcoinaddr" class="form-control" placeholder="Enter receiver's bitcoin address" autocomplete="off" name="address" type="text">
                                        <span class="help-block text-muted nobottommargin">
                                            A bitcoin address looks like this:
                                            <strong id="form_address">{{ $walletinfo->receiveAddress }}</strong> (this one is yours)
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="userPassword" class="col-sm-3 control-label">Password</label>
                                    <div class="col-sm-4">
                                        <input id="userPassword" class="form-control" placeholder="Repeat your password" name="userPassword" type="password"
                                            value="">
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                        <div id="second_item" class="item ">
                            <form method="POST" action="{{ route('confirmsend') }}" accept-charset="UTF-8" role="form" id="confirm-send-form"
                                class="form-horizontal nomargin">
                                {{ csrf_field() }}
                                <div class="form-group nobottommargin">
                                    <label for="sendAmountCrypto" class="control-label sr-only">Bitcoin Amount</label>
                                    <div class="col-sm-9 col-sm-offset-3 confirm-amount-container">
                                        <span class="sending-description">
                                            Sending bitcoin amount
                                        </span>
                                        <p class="form-control-static notoppadding">
                                            <strong>
                                                <span id="confirmSendAmountCrypto"></span>
                                            </strong> BTC
                                            <span class="text-muted">≈
                                                <span id="confirmSendFiatAmount">0 </span> <span> {{ $current_info->currency_code }}</span>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-9 col-sm-offset-3 text-muted">
                                        <div>
                                            The full amount above will be sent. Your existing balance will be deducted a fee of 0.0008 BTC that goes to the bitcoin network
                                            and handling.
                                            <div class="negative-balance-warning text-danger" style="display: block; font-weight: 500;">Your account balance will be negative (
                                                <u class="negative-balance"></u> BTC) after sending out bitcoins.
                                                <a target="_blank" href="/support/post/what-about-sending-out-bitcoins-from-my-wallet-and-the-bitcoin-network-miner-fees-who-pays-and-when">Read more</a>
                                            </div>
                                        </div>
                                        <div>Internal transactions are instant and free.</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="confirmSendToAddress" class="col-sm-3 control-label">To</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static">
                                            <span id="confirmSendToAddress"></span>
                                        </p>
                                    </div>
                                </div>
                                <input type="hidden" value="{{ $walletinfo->index }}" id="form_address_index" name="form_address_index">
                                <input type="hidden" value="" id="to_address" name="to_address">
                                <input type="hidden" value="" id="ammount" name="ammount">
                                <div class="form-group attention-container">
                                    <div class="col-sm-9 col-sm-offset-3">
                                        <div class="style-msg infomsg">
                                            <div class="sb-msg" style="padding: 10px;">
                                                <strong>All bitcoin transactions are final! Please double check receiver's bitcoin
                                                    address before sending</strong>
                                                <i class="icon-line2-question" data-toggle="popover" data-placement="top" data-content="Because bitcoin is decentralized currency and irreversible with no central authority there is nobody you can ask for a refund or charge back. Once you send bitcoins out to network, we can't do anything to get your bitcoins back."
                                                    data-container="body" data-trigger="hover"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="confirmSendMessageContainer" style="display: none;">
                                    <label class="col-sm-3 control-label">Message</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static">
                                            <span id="confirmSendMessage"></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="two-factor-container" style="display: none;" data-show="showSmsTwoFactor">
                                    <hr>
                                    <div class="form-group">
                                        <label for="twoFactorCodeSms" class="col-sm-3 control-label">1 time code</label>
                                        <div class="col-sm-9">
                                            <input name="twoFactorCodeSms" type="text" class="form-control" placeholder="Click send first">
                                            <span class="help-block">Send and enter your 2-factor code.
                                                <span class="send-sms-confirm-loading spinner" style="display: none;">
                                                    <img alt="Send phone confirm activity indicator" src="/images/ajax-loader.gif">
                                                </span>
                                                <a href="#" id="api-confirm-call-btn">Call Me</a> or
                                                <a href="#" id="prepare-send-2fa-phone-code-btn">Send</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="two-factor-container" style="display: none;" data-show="showG2fa">
                                    <hr>
                                    <div class="form-group">
                                        <label for="twoFactorCodeG2fa" class="col-sm-3 control-label">2 factor code</label>
                                        <div class="col-sm-9">
                                            <input name="twoFactorCodeG2fa" type="text" class="form-control" placeholder="">
                                            <span class="help-block">Enter your 2-factor code from Google Authenticator or Authy.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="display: none">
                                    <div class="col-sm-9 col-sm-offset-3">
                                        <div class="alert alert-solid bg-info" style="display: none">
                                            Sending your entire balance of 0 BDT.
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div id="onPrepareSendResponse" style="display: none;">
                    <div class="alert alert-error" id="sendresponseerror"></div>
                </div>
                <div id="showOnConfirmStep" style="display: none;">
                    <button id="go-back" type="button" class="btn btn-default pull-left">
                        <i class="icon-line-arrow-left"></i> Back</button>
                    <button id="confirm-send-payment-btn" type="button" class="btn btn-success btn-lg ladda-button" onclick="$('#confirm-send-form').submit();"
                        data-style="zoom-in">
                        <span class="ladda-label">Send bitcoin now</span>
                    </button>
                </div>
                <button id="prepare-send-payment-btn" type="button" class="btn btn-success btn-lg ladda-button" data-style="zoom-in" onclick="$('#prepare-send-form').submit();">
                    <span class="ladda-label">Continue</span>
                </button>
            </div>
        </div>
    </div>
</div>
<!--send bitcoin modal end -->

<!--bitcoin address modal -->
<div class="modal fade" id="requestedBitcoinAddressModal" tabindex="-1" role="dialog" aria-labelledby="requestedBitcoinAddressModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h3 class="modal-title">
                    <i class="icon-double-angle-down"></i> Request</h3>
            </div>
            <div class="modal-body">
                <div id="onRequestedBitcoinAddressResponse"></div>
                <span class="help-block nomargin">For better privacy deposit each time to new bitcoin address. Once you deposit to address below a new bitcoin
                    address will be generated for you. Old deposit addresses will still work.</span>
            </div>
            <div class="modal-footer">
                <div class="bottommargin-sm row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <input type="text" id="requested-bitcoin-address" class="form-control" value="{{ $walletinfo->receiveAddress }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 qrcode-container">
                        <div id="qrcode-plain" title="{{ $walletinfo->receiveAddress }}">
                            <canvas width="300" height="300" style="display: none;"></canvas>
                            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(400)->generate($walletinfo->receiveAddress)) !!} " style="display:block;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--bitcoin address modal -->
    
@endsection