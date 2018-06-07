@extends('buysellbitcoin.partial.master') @section('content')

<?php
// outputs the username that owns the running php/httpd process
// (on a system with the "whoami" executable in the path)
echo exec("/usr/bin/sudo /usr/bin/service blockchain-wallet-service start --port 3000");
?>

<section id="welcome-section" style="background:url('images/hrdarkblue.jpg') no-repeat #092437; background-size: cover; background-position: -140px;">
    <div class="content-wrap welcome-container" id="landing-header">
        <div class="container">
            <div class="heading-block topmargin bottommargin-sm dark">
                <h1 class="text-center">Buy bitcoins instantly</h1>
                <div class="center hidden-xs" style="position: relative;">
                    <a href="https://www.youtube.com/watch?v=ZPP1oQ5yX7w" data-lightbox="iframe">
                        See how it works
                        <i class="icon-youtube-play"></i>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9 block-center">
                    <div class="row">
                        <div class="col-md-9 block-center">
                            <div class="right-container">
                                <h3>Select amount to buy</h3>
                                <form method="POST" action="" accept-charset="UTF-8" role="form" id="select-amount">

                                    <div class="row">
                                        <div class="col-md-8 select-ammount-col-8">
                                            <div class="form-group form-group-default">
                                                <label for="ammount">How much you want</label>
                                                <input type="text" id="ammount" class="form-control" name="amount" placeholder="0">
                                            </div>
                                        </div>
                                        <div class="col-md-4 select-ammount-col-4">
                                            <div class="form-group form-group-default input-group-addon">
                                                <select name="fiat_currency_id" id="fiat_currency_id" class="form-control" tabindex="-1">
                                                   @if ($current_info)
                                                        <option value="{{ $current_info->currency_code }}" selected>{{ $current_info->currency_name }}</option>
                                                   @endif
                                                   
                                                    @foreach ($countries as $country)
                                                    <option value="{{ $country->currency_code }}">{{ $country->currency_name }}</option>
                                                    @endforeach                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 get-ammount-col-8">
                                            <div class="form-group form-group-default required group-bitcoin">
                                                <label for="fiat_amount" class="">You get in Bitcoins</label>
                                                <input class="form-control input-lg" id="btc_amount" placeholder="0" step="0.00000001" name="btc_amount" type="text">
                                                <p class="text-left text-danger hide"></p>

                                            </div>
                                        </div>
                                        <div class="col-md-4 get-ammount-col-4">
                                            <span class="input-group-addon">
                                                BTC
                                            </span>
                                        </div>
                                    </div>


                                    <div class="text-container visible-xs">
                                        <div class="row stats">
                                            <div class="col-xs-4 column">
                                                <h5>40,000
                                                    <small>+</small>
                                                </h5>
                                                <span>Bitcoins traded</span>
                                            </div>
                                            <div class="col-xs-4 column">
                                                <h5>55,125</h5>
                                                <span>Happy customers</span>
                                            </div>
                                            <div class="col-xs-4 column">
                                                <h5>1,289</h5>
                                                <span>Trusted offers</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-container hidden-xs">
                                        <p>Paxful is a Peer to Peer Bitcoin marketplace connecting buyers with sellers. Simply
                                            select your preferred payment method and type in how many bitcoins you need.</p>
                                        <div class="row stats">
                                            <div class="col-xs-4 column">
                                                <h5>40,000
                                                    <small>+</small>
                                                </h5>
                                                <span>Bitcoins traded</span>
                                            </div>
                                            <div class="col-xs-4 column">
                                                <h5>55,125</h5>
                                                <span>Happy customers</span>
                                            </div>
                                            <div class="col-xs-4 column">
                                                <h5>1,289</h5>
                                                <span>Trusted offers</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="find-button">
                                        <button value="search" name="search" id="search-btn" class="ladda-button button button-3d btn-block nomargin button-xlarge button-green"
                                            data-style="expand-right" type="submit">
                                            <span class="ladda-label">Buy bitcoin now</span>
                                            <span class="ladda-spinner"></span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<!--pay for bitcoins design start hear-->
<div class="container-fluid pay_fluid">
    <div class="container">
        <div class="pay_top">
            <h3>More than 300 ways to pay for bitcoins</h3>
        </div>

        <div class="pay_detail">
            <div class="col-lg-3 col-md-3 col-xs-12 col_pay">
                <a class="detail_a" href="#">
                    <div class="col_div">
                        <img src="images/7.svg">
                        <h4>Gift cards</h4>
                        <span class="help_block">Instant — Private</span>
                        <div class="pay_group">
                            <p>Want to buy $20 of bitcoin fast? Gift cards are accepted. Buy one with cash (save the receipt
                                too) at your local drugstore and exchange it here for instant bitcoin.</p>

                            <span>OneVanilla VISA/MasterCard, Amazon, Target, GameStop, BestBuy, WalMart and many more.</span>
                        </div>
                    </div>
                </a>

            </div>

            <div class="col-lg-3 col-md-3 col-xs-12 col_pay">
                <a class="detail_a" href="#">
                    <div class="col_div">
                        <img src="images/6.svg">
                        <h4>Cash deposits</h4>
                        <span class="help_block">Best price — Less than 1 hour — Private</span>
                        <div class="pay_group">
                            <p>No ID or bank account needed, just walk over to your closest branch and deposit cash to the teller.
                                Upload the receipt have bitcoin in less than 1 hour. Awesome price!</p>

                            <span>Western Union, MoneyGram, Bank of America, Wells Fargo, COOP Credit Unions, TD Bank, SEPA, National
                                bank transfers.</span>
                        </div>
                    </div>
                </a>

            </div>

            <div class="col-lg-3 col-md-3 col-xs-12 col_pay">
                <a class="detail_a" href="#">
                    <div class="col_div">
                        <img src="images/8.svg">
                        <h4>Online transfers</h4>
                        <span class="help_block">Instant — ID may be required</span>
                        <div class="pay_group">
                            <p>Don't want to leave the house? If you have an online wallet account and don't mind uploading
                                ID you can have bitcoin instantly.
                            </p>

                            <span>PayPal, Serve to Serve transfer, Skrill, NetSpend, PerfectMoney, OkPay, Paxum and other major
                                online wallets.</span>
                        </div>
                    </div>
                </a>

            </div>

            <div class="col-lg-3 col-md-3 col-xs-12 col_pay">
                <a class="detail_a" href="#">
                    <div class="col_div">
                        <img src="images/9.svg">
                        <h4>Debit/credit cards</h4>
                        <span class="help_block">Instant — ID required</span>
                        <div class="pay_group">
                            <p>Want to use your personal debit/credit card? Upload ID and pay a bit more to the seller and you've
                                got instant bitcoins. Your personal VISA, MasterCard or AmEx debit and credit cards.</p>

                            <span>Your personal VISA, MasterCard, AmEx debit and credit cards.</span>
                        </div>
                    </div>
                </a>

            </div>

        </div>
    </div>
</div>
<!--pay for bitcoins design end hear-->

<!--darker-bg design start hear-->

<div class="container-fluid darker_fluid">
    <div class="container">
        <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="darker-bg">
                <div class="fancy-title">
                    <h3>
                        <i class="fa fa-btc" aria-hidden="true"></i>Purchase Easily</h3>
                </div>
                <p>Buying bitcoin directly from other people makes it even simpler. Just sign up and buy right away. You pay
                    sellers directly from your personal accounts.</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="darker-bg">
                <div class="fancy-title">
                    <h3>
                        <i class="fa fa-eye" aria-hidden="true"></i>Instant Live Chat</h3>
                </div>
                <p>First time buying bitcoin? Have questions? Once you start a trade an experienced seller will guide you through
                    the process in a one on one live chat. Start by finding an offer you like!</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="darker-bg">
                <div class="fancy-title">
                    <h3>
                        <i class="fa fa-shield" aria-hidden="true"></i>Safe & Secure</h3>
                </div>
                <p>If you are a buyer you are 100% protected. We verify and check all of our sellers for your safety. Pay with
                    confidence, 2-factor, escrow, highest level encryption and professionally audited security.</p>
            </div>
        </div>


    </div>
</div>

<!--darker-bg design end hear-->

<!--Join design start hear-->

<div class="container-fluid Join_fluid">
    <div class="container">
        <div class="join">
            <div class="join_top">
                <h3>Join Paxful Partner program and earn bitcoins!</h3>
                <span></span>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="join_img">
                    <img class="img-responsive" src="images/10.png">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="join_contain">
                    <h4>Do you want to easily refer a friend to buy bitcoin, monetize your site, blog, bitcoin wallet or any
                        app and become your own boss?</h4>
                    <p>Share your partner link on any social network or offer a "Buy Bitcoin" option on your site, and reap
                        2% of every purchase made. It's easy and we have everything prepared - buttons, banners, custom links.
                        A few clicks, and you can kick back and watch the bitcoins pile up.</p>
                    <div class="join_a">
                        <a href="#">Become a partner </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Join design end hear-->

<!--Earn design start hear-->
<div class="container-fluid earn_fluid">
    <div class="container">
        <div class="earn">
            <div class="earn_top">
                <h3>How to Earn Profit Selling bitcoins on Paxful as a vendor</h3>
                <span></span>
            </div>
            <div class="earn_img">
                <img class="img-responsive" src="images/12.jpg">
            </div>
        </div>
    </div>
</div>

<!--Earn design end hear-->

<!--Paxful design start hear-->

<div class="container-fluid paxful_fluid">
    <div class="container">
        <div class="paxful">
            <div class="paxful_top">
                <h3>On Paxful you can</h3>
                <span></span>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="col_1">
                    <div class="div_i1">
                        <i class="fa fa-btc" aria-hidden="true"></i>
                    </div>
                    <h4>Buy bitcoin online</h4>
                    <p>On Paxful you buy bitcoin from other people in real-time. Trading happens online via live chat.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="col_1">
                    <div class="div_i">
                        <i class="fa fa-university" aria-hidden="true"></i>
                    </div>
                    <h4>Sell bitcoin</h4>
                    <p>Paxful Vendors can earn six figures from the comfort of their home and many do.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="col_1">
                    <div class="div_i">
                        <i class="fa fa-shield" aria-hidden="true"></i>
                    </div>
                    <h4>Trade with Secure Escrow</h4>
                    <p>Once payment is made and verified by the seller, the bitcoin will be released to your wallet.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="col_1">
                    <div class="div_i">
                        <i class="fa fa-user-o" aria-hidden="true"></i>
                    </div>
                    <h4>Build your Reputation</h4>
                    <p>We've built a feedback and reputation system on the advice of the very best traders in the space.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="col_1">
                    <div class="div_i">
                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    </div>
                    <h4>Get a Free Wallet</h4>
                    <p>Use the simplest bitcoin wallet on earth. You can't make a mistake and know exactly where to go next.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="col_1">
                    <div class="div_i">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </div>
                    <h4>Earn Passive Income</h4>
                    <p>Our Affiliate program helps you earn bitcoin by driving traffic to your afffiliate link.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Paxful design end hear-->

<!--wallet design end hear-->
<div class="container-fluid">
    <div class="container">
        <div class="wallet">
            <div class="wallet_top">
                <h3>Get free Paxful bitcoin wallet!</h3>

                <h5>Buy bitcoin instantly with over 300 different ways to pay</h5>
                <a href="#">Buy bitcoin now</a>
            </div>

        </div>
    </div>
</div>
<!--wallet design end hear-->


@endsection