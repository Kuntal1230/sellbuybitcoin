@extends('buysellbitcoin.partial.master') @section('content')
<div id="vue_id">
    <div class="container-fluid  offer_banner_fluid">
        <div class="container">
            <div class="offer_banner">
                <h1 class="offer_banner_h1">Buy bitcoins with Litecoin LTC for US Dollars (USD)</h1>
                <h5 class="offer_banner_h5">Transfer</h5>
            </div>
        </div>
    </div>

    @guest
    <div class="container-fluid free_fluid">
        <div class="container">

            <div class="free_form">
                <h4 class="ml-15">First get your free bitcoin wallet</h4>
                <form>
                    <div class="form-row free_form_div">

                        <div class="col">
                            <input type="text" class="form-control free_input" placeholder="Choose your username">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control free_input" placeholder="Your Email">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control free_input" placeholder="Choose password">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control free_input" placeholder="Type password again">
                        </div>
                        <div class="free_button_div">
                            <button type="button" class="btn btn-primary btn-lg btn-block free_button">CREATE FREE ACCOUNT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endguest



    <div class="container-fluid offer_fluid">
        <div class="container">
            <div class="col-lg-8 col-md-8 col-xs-12">
                <div class="offer_col_L">
                        @foreach ($errors->all() as $message)
                        <div class="alert alert-danger">
                                <strong>Warning!</strong> {{ $message }}
                              </div>
                        @endforeach
                    @if (Auth::user()->trade->where('trade_status',1)->count())
                    @php
                        $activetrade = Auth::user()->trade->where('trade_status',1)->first();
                    @endphp
                        <div class="fail-reason">
                            <p class="send-request-fail-reason">
                                You have too many unfinished buy contacts! You must finish at least one of them before you can make new ones. Your unfinished buy contacts are <a href="{{ route('view.trade',['slug'=>$activetrade->slug]) }}">#{{ $activetrade->slug }}</a>
                            </p>
                        </div>
                        
                       
                    @else
                        <form action="{{ route('start.trade') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="how_much">
                                <h4 class="how_much_h4">How much do you want to buy?
                                    <span class="how_much_span">
                                        <a class="how_much_a" href="#">click here for help</a>
                                    </span>
                                </h4>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-12">
                                        <div class="input-group" v-bind:class="{'has-error': hasError }">

                                            <input type="hidden" name="trade_slug" value="{{ rand(10000000,99999999) }}">

                                            <input type="hidden" id="margin" value="{{ $offer->margin }}">

                                            <input type="hidden" id="custom_rate" value="{{ $offer->offer_price }}">

                                            <input type="hidden" name="offer_id" value="{{ $offer->id }}">

                                            <input type="hidden" name="offer_author" value="{{ $offer->user_id }}">

                                            <input type="hidden" name="exchange_rate" value="{{ number_format($offer->offer_price,2) }}">

                                            <input type="number" class="form-control" name="amount_fiat" id="amount_fiat" v-model="amount_fiat" v-on:keyup="check1" step="0.01" min="{{ $offer->min_ammount }}"
                                                max="{{ $offer->max_ammount }}" placeholder="ex.{{ $offer->min_ammount }}" number>
                                            <span class="input-group-addon" id="fiat_currency_id">{{ $offer->country->currency_code }}</span>
                                        </div>
                                        

                                    </div>
                                    <div class="popover fade bottom in" role="tooltip" style="top: 94px; left: 72.6875px;" v-bind:style="{color: color,display:display}">
                                            <div class="arrow" style="left: 50%;"></div>
                                            <div class="popover-content">Trade limit is <strong>{{ $offer->min_ammount }}—{{ $offer->max_ammount }}</strong> {{ $offer->country->currency_code }}</div>
                                        </div>
                                    <div class="col-lg-6 col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <input type="number" class="form-control" step="0.00000001" name="amount_btc" id="amount_btc" v-model="amount_btc" v-on:keyup="check2" placeholder="0" number>
                                            <span class="input-group-addon">BTC</span>
                                        </div>
                                    </div>
                                    <span class="market-price-box lead" v-bind:style="{display:Yougotdisplay}"> You get 
                                        <strong>
                                            <span id="market-price-value">@{{ youget }}</span>
                                        </strong> {{ $offer->country->currency_code }} worth of bitcoin <i class="icon-line2-question" data-toggle="popover" data-placement="top" data-content="Sellers set their own price based on quickness, privacy and convenience of buying bitcoins." data-container="body" data-trigger="hover" data-original-title="" title=""></i>
                                    </span>
                                </div>
                            </div>
                            <div class="offer_button_div">
                                <input type="hidden" id="reciverid" value="{{ $offer->author->id }}">
                                <input type="hidden" id="senderid" value="{{ Auth::user()->id }}">
                                <button type="submit" class="btn btn-lg btn-block offer_button ladda-button" data-style="zoom-in" v-bind:class="{'disabled': disabled}" @guest disabled="true" @endguest>
                                    <span class="offer_button_span1">buy now</span>
                                    <span class="offer_button_span2">Secure escrow + live chat with Tundebabs</span>
                                </button>
                                @guest
                                <span class="offer_button_span3">
                                    <i class="fa fa-info offer_button_i" aria-hidden="true"></i> To start a trade, please sign up above</span>
                                @endguest


                            </div>
                        </form>
                        
                    @endif
                   
                    <div class="ngn_div">
                        <h4 class="ngn_h4">Minimum is
                            <span class="ngn_span" id="min_ammount">{{ $offer->min_ammount }}  </span> {{ $offer->country->currency_code }}
                        </h4>
                        <h4 class="ngn_h4">Maximum trade
                            <span class="ngn_span" id="max_ammount"> {{ $offer->max_ammount }} </span> {{ $offer->country->currency_code }}
                        </h4>
                        <h4 class="ngn_h4">Rate
                            <span class="ngn_span" id="rates">{{ number_format($offer->offer_price,2) }}</span> {{ $offer->country->currency_code }} per bitcoin (you
                            can buy any fraction of bitcoin)</h4>
                    </div>
                    <div class="quick_div">
                        <h4 class="quick_h4">Quick Offer Overview</h4>
                        <div class="col_div">
                            @foreach ($offer->tag as $tag)
                                <div class="col-lg-4 col-md-4 col-xs-12">
                                    <div class="needed">
                                        <img class="needed_img" src="">
                                        <p class="needed_p">{{ $tag->name }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="quick_div">
                        <h4 class="quick_h4">Offer terms by {{ $offer->author->name }}
                            <span class="pull-right Community_span">
                                <a class="Community_a" href="#">Community tips</a>
                            </span>
                        </h4>

                        <div class="col_div">
                            <p class="Open_p">{{ $offer->offer_terms }}</p>
                            <a class="Community_a" href="#">Do you accept offer terms? Click to buy bitcoins now!</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="offer_col_R">
                    <div class="feature_box_div">
                        <div class="seen_det">
                            <div class="seen_det_img">
                                <img class="seen_img img-circle" itemprop="image" src="{{ asset('storage/'.$offer->author->avatar) }}">
                            </div>
                            <div class="seen_det_div2">
                                <a class="seen_tag_a" href="#">{{ $offer->author->name }}</a>
                                <p class="seen_tag_p">
                                    <i class="fa fa-circle {{ $offer->author->isOnline()?'online':'offline' }}" aria-hidden="true"></i>
                                    @if ($offer->author->isOnline()) Seen just now @else Last seen {{$offer->author->last_seen->diffForHumans() }} @endif
                                    <br> Reputation
                                    <span class="seen_tag_span2">+{{ $offer->author->feedback->where('identifire','+')->count() }}</span> /
                                    <span class="seen_tag_span3">-{{ $offer->author->feedback->where('identifire','-')->count() }}</span>
                                </p>

                            </div>
                        </div>

                        <div class="profile_media_div">
                            <h4 class="profile_media_h4">Share this offer:</h4>
                            <a class="profile_media_a" href="#">
                                <i class="fa fa-facebook profile_media_facebook" aria-hidden="true"></i>
                            </a>
                            <a class="profile_media_a" href="#">
                                <i class="fa fa-twitter profile_media_twitter" aria-hidden="true"></i>
                            </a>
                            <a class="profile_media_a" href="#">
                                <i class="fa fa-envelope profile_media_email" aria-hidden="true"></i>
                            </a>
                        </div>

                        <div class="feedback">
                            @if ($offer->author->feedback)
                            <h4 class="feedback_h4">Recent feedback</h4>                                
                                <ul class="feedback_ul">
                                    @foreach ($offer->author->feedback as $feedback)
                                        <li class="feedback_li">
                                            <a class="feedback_a" href="#">{{ $feedback->author->name }}</a>wrote:
                                            <br>{{ $feedback->mesage }}
                                            <br>
                                            <span class="feedback_span1">{{ $feedback->identifire }}{{ $feedback->ratting }}
                                                @if ($feedback->identifire == '+')
                                                Positive
                                                @elseif ($feedback->identifire == '-')
                                                Negative 
                                                @else
                                                Neutral 
                                                @endif
                                            </span>
                                            <span class="feedback_span2">— {{ $feedback->created_at->format('F d, Y') }}</span>

                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                
                            @endif                            
                        </div>
                        <p class="the_p">
                             The buyer of bitcoin has a time limit of
                            <span class="the_span">{{ $offer->payment_window }}</span> minutes
                            to pay for the bitcoin before the trade is cancelled by the system. Trade
                            won't auto-cancel when buyer has marked trade as paid. After that buyer has to wait for seller
                            to release bitcoins.
                        </p>






                    </div>
                </div>
            </div>
        </div>
    </div>




    <!--Trust design start hear-->
    <div class="container-fluid trust_fluid">
        <div class="container">
            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="trust">
                    <i class="fa fa-shield trust_i" aria-hidden="true"></i>
                    <h4 class="trust_h4">Secure Escrow</h4>
                    <span class="trust_span"></span>
                    <p class="trust_p">Our escrow system protects you by holding the sellers bitcoins in escrow. When payment is completed the
                        bitcoins are released to your wallet.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="trust">
                    <i class="fa fa-bolt trust_i" aria-hidden="true"></i>
                    <h4 class="trust_h4">Instant Use</h4>
                    <span class="trust_span"></span>
                    <p class="trust_p">Once you have bitcoins using them is instant. You can send them or spend them with no delays.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="trust">
                    <i class="fa fa-comment-o trust_i" aria-hidden="true"></i>
                    <h4 class="trust_h4">Chat Support</h4>
                    <span class="trust_span"></span>
                    <p class="trust_p">When you start a trade you will be speaking with a vendor via live chat. Read their instructions and
                        ask them questions. Many will be happy to walk you through.</p>
                </div>
            </div>
        </div>
    </div>
    <!--Trust design end hear-->
</div>
@endsection

@section('pagejs')

   <script type="text/javascript">
   $('.offer_button').click(function(){
       var trade_time = $('.the_span').html();
    Cookies.set('extime', (trade_time*60));
   });        
    </script>

@endsection