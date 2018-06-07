@extends('buysellbitcoin.partial.master') @section('content')
<div id="vue_id">
    <div class="container-fluid online_sell_buyer_fluid">
        <div class="container">
            <div class="online_sell_buyer_header">
                    <input type="hidden" id="slug" name="slug" value="{{ $trade->slug }}">
                    <input type="hidden" id="start_time" name="start_time" value="{{ $trade->created_at->timestamp }}">
                    <input type="hidden" id="total_time" name="total_time" value="{{ $trade->offer->payment_window }}">
                <h1 class="online_sell_buyer_header_h1 text-center">Contact #{{ $trade->slug }}: Buying {{ $trade->amount_btc }} bitcoins for {{ $trade->amount_fiat }} {{ $trade->offer->country->currency_code }} with</h1>
                <h4 class="online_sell_buyer_header_h4 text-center">Buying from
                    <span class="online_sell_buyer_header_span">advertisement #{{ $trade->offer->offer_slug }}</span> ({{ $trade->offer->paymentmethod->name }}) by
                    <span class="online_sell_buyer_header_span">{{ $trade->offer->author->name }}</span> at the exchange rate {{ $trade->exchange_rate }} {{ $trade->offer->country->currency_code }} / BTC.</h4>
            </div>
            <div class="col-md-12">
                <div class="well">
                    Trade status:
                    <strong id="trade_status">Waiting for buyer to confirm payment.</strong>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="online_sell_buyer_L">
                        <div class="escrowbox well">
                            <div id="payment_instructions" style="">
                                <h3>Step 1: Pay the seller</h3>
                                <p>
                                    The reference message
                                    <strong>must be</strong> included or the seller can't identify your payment.
    
                                    <strong>Send a message to the proboy</strong> to receive help with completing the payment.
                                </p>
    
                                <div id="payment-details" class="payment-details">
                                    Method: national bank
                                    <br>diamond bank
                                    <br>Amount: 1000000.00 NGN
                                    <br>Reference/message: L22421167BDCKA7
                                </div>
    
                                <br>
                                <div class="panel-group" id="accordion_terms_of_trade" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="heading_terms_of_trade">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion_terms_of_trade" href="#collapse_terms_of_trade" aria-expanded="false" aria-controls="collapse-cancel"
                                                    class="collapsed">
                                                    <i class="fa fa-chevron-right"></i>&nbsp;Terms of trade with
                                                    <i>proboy</i>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse_terms_of_trade" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_terms_of_trade"
                                            aria-expanded="false" style="height: 0px;">
                                            <div class="panel-body messagetext">
    
                                                Payment should be made as a direct bank deposit or as an Internet bank transfer from an account with the same name as the
                                                one on your LBC profile or trade will be cancelled or if provided you have at
                                                least more than 40 transactions.
                                                <br>
                                                <br>Note.. i will not release coin until i confirm payment from my end
                                                <br>
                                                <br>
                                                <br>No ATM deposit , No cheque deposit please !!! and do not initiate trade when
                                                you know you wont be online to complete it ..once you know you will be offline
                                                pls cancel the trade.
                                                <br>
                                                <br>
                                                <br>Only make a request if you can complete the payment within 1 hour. Only mark
                                                as paid after you have actually completed the payment. Any Questions , Please
                                                Do not hesitate to contact me.
    
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
    
                                <h3>Step 2: Confirm the payment</h3>
                                <p>
                                    The bitcoins are held in escrow for
                                    <strong id="timer1"></strong> minutes, during which it is safe to pay. After paying,
                                    <strong>you need to mark payment complete</strong> by pressing the I have paid button or the trade
                                    will automatically cancel.
                                </p>
    
                                <p class="text-center">
                                    <a rel="nofollow" id="mark-payment-complete" data-toggle="modal" data-target="#escrow_modal" href="" class="btn btn-primary">
                                        <i class="fa fa-play"></i>
                                        I have paid
                                    </a>
                                </p>
    
    
                            </div>
    
    
    
    
                        </div>
    
    
                        <div class="Verify_row_1">
                            <div class="Verify_div">
                                <h3 class="Verify_h3">Resolving trade issues </h3>
                                <p class="Verify_p">See More information about trading below for common issue resolutions.</p>
                            </div>
    
    
    
                            <div class="faqs">
                                <ul class="faqs_ul">
                                    <li class="faqs_li">
                                        <span class="faqs_span" id="span2" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
    
                                            <i class="fa fa-chevron-right faqs_i" id="icone_id_2" aria-hidden="true"></i>
                                        </span>
    
                                        <h4 class="faqs_h41"> Canceling the trade </h4>
    
                                        <div id="collapse2" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <p class="Verify_p"> Made a mistake with payment or want to try another seller?
                                                    <strong>Never cancel if you already paid the seller.</strong>
                                                </p>
                                                <form id="confimrform" action="{{ route('confirm.action') }}" method="POST">
                                                    {{ csrf_field() }}
    
                                                    <input type="hidden" name="action_url" value="trade/cancel/{{ $trade->slug }}">
    
                                                    <input type="hidden" name="msg" value="Are you sure you want to cancel the purchase {{ $trade->slug }}, {{ $trade->amount_fiat }} {{ $trade->offer->country->currency_code }}?">
    
                                                    <input type="hidden" name="header" value="Confirm purchase cancellation.">
    
                                                    <p class="text-center">
                                                      <button id="cancel_online_trade_buyer" type="submit" name="submit" class="btn btn-danger">
                                                        <i class="fa fa-times"></i>
                                                        Cancel purchase
                                                      </button>
                                                    </p>
                                                  </form>
    
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
    
    
    
    
    
    
    
                        </div>
                    </div>
                </div>

            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="online_sell_buyer_R">
                    <div class="send_div">
                        <div class="send_row_1">
                            <i class="fa fa-comment send_row_i" aria-hidden="true"></i>
                            <h4 class="send_row_h4">Send message to
                                <span class="send_row_span1">{{ $trade->offer->author->name }}</span>
                                <input type="hidden" id="reciverid" value="{{ $trade->offer->author->id }}">
                                <input type="hidden" id="senderid" value="{{ Auth::user()->id }}">
                                <i class="fa fa-circle {{ $trade->offer->author->isOnline()?'online':'offline' }}" aria-hidden="true"></i>
                            </h4>
                            <span class="label label-primary">@{{ typing }}</span>
                        </div>
                        <form action="" method="post" id="talkSendMessage">
                            {{ csrf_field() }}
                            <div class="send_row_2">
                                <textarea class="send_row_message" id="btn-input" placeholder="Write your message" name="message-data" id="message-data"></textarea>
                                <input type="hidden" name="_id" value="{{ $trade->offer->author->id }}">
                            </div>
                            <div class="send_row_3">
                                <button class="btn btn-primary" id="btn-chat" type="submit">Send</button>
                                <button type="button" class="btn btn-outline-secondary send_row_button2">Attach document</button>
                            </div>
                        </form>
                        <div id="talkMessages">
                            @foreach ($messages as $message)
                            @if($message->sender->id == auth()->user()->id)
                                <div class="send_row_4" id="message-{{$message->id}}">
                                    <p class="send_row_p">
                                        {{$message->humans_time}} ago
                                        <br>
                                        <strong>{{$message->sender->name}}</strong>:
                                        <br>
                                        {{$message->message}}
                                    </p>
                                </div>
                            @else
                                <div class="send_row_4" id="message-{{$message->id}}">
                                    <p class="send_row_p">
                                            {{$message->humans_time}} ago
                                        <br>
                                        <strong>{{$message->sender->name}}</strong>:
                                        <br>
                                        {{$message->message}}
                                    </p>
                                </div>

                            @endif
                            @endforeach
                            
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

    <div id="escrow_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="escrow-form-label" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button id="escrow-popup-close" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="register-form-label">Confirm payment</h3>
                </div>

                <div class="modal-body">
                    <p>
                        You, <b>{{ Auth::user()->name }}</b>, declare that you have
                    </p>
                    <ul>
                        <li>you have accepted <a target="_blank" href="">the terms of the trade</a> of advertisement #{{ $trade->offer->offer_slug }}</li>
                        <li>you have completed the payment according to the instructions given to you by the seller</li>
                    </ul>
                    <p></p>
                    <p>
                        If you are unsure how to pay with <b>{{ $trade->offer->paymentmethod->name }}</b>
                        please contact <b>{{ $trade->offer->author->name }}</b> to ask for help with how to pay, or <i>Cancel the trade</i>.
                    </p>
                </div>
                <div class="modal-footer">
                    <a rel="nofollow" href="" id="login-button" class="btn btn-success" type="submit">Confirm payment complete</a>
                    <button id="login-popup-cancel" class="btn btn-default" data-dismiss="modal" aria-hidden="true">I did not pay yet</button>
                </div>

            </div>
        </div>
    </div>


@endsection

@section('pagejs')

{{-- <script src="{{ asset('chat/js/index.js') }}"></script> --}}

<script src="{{ asset('chat/js/talk.js') }}"></script>

<script src="{{ asset('js/jquery.countdown.js') }}"></script>

   <script type="text/javascript">
       var start = $('#start_time').val();
        var time = $('#total_time').val();
        var fiveSeconds = start + (time*60);
                $('#timer1').countdown(fiveSeconds, {elapse: true})
                .on('update.countdown', function(event) {
                var $this = $(this);
                if (event.elapsed) {
                    $this.html(event.strftime('After end: <span>%H:%M:%S</span>'));
                } else {
                    $this.html(event.strftime('To end: <span>%H:%M:%S</span>'));
                }
                });

        var msgshow = function(data) {
            var html = '<div class="send_row_4" id="message-'+data.id+'">'+
                        '<p class="send_row_p">'+
                                '1 Second ago'+
                            '<br>'+
                            '<strong>'+ data.sender.name +'</strong>:'+
                            '<br>'+
                            data.message +
                        '</p>'+
                    '</div>';

            $('#talkMessages').append(html);
            
        }
</script>
{!! talk_live(['user'=>["id"=>auth()->user()->id, 'callback'=>['msgshow']]]) !!}
@endsection