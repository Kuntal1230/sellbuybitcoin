<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>mybitcoinbuysell</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> {{--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/ladda.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/res.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/ion.rangeSlider.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/ion.rangeSlider.skinHTML5.css') }}">
    <style>
        /* Note: Try to remove the following lines to see the effect of CSS positioning */

        .affix {
            /* padding-top: 10px; */
            /* min-height: 80px; */
            top: 0;
            width: 100%;
            z-index: 999 !important;
            background-color: #000000d1;
        }

        .affix .navbar-nav>li>a {
            color: #fff8f8;
            font-weight: 700;
            padding: 11px 15px;
        }

        .affix+.container-fluid {
            padding-top: 70px;
        }
    </style>
</head>

<body class="@yield('body-class')">
    @auth
    <input type="hidden" id="sessioncheck" value="{{ Auth::user()->id }}">
    @endauth
    <input type="hidden" id="user_ip_currency" name="user_ip_currency" value="{{ $current_info->currency_code }}">
    <input type="hidden" id="user_ip_country" name="user_ip_country" value="{{ $current_info->country_code }}">
        
    <div id="app">
        <!--nav design start hear-->
        <nav class="navbar navbar-default navbar_full" data-spy="affix" data-offset-top="65">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('images/mybitcoin.png') }}" alt="">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav nav-design">

                        <li>
                            <a href="{{ route('buy-sell') }}">Buy/Sell Bitcoin</a>
                        </li>
                        <li>
                            <a href="{{ route('create.offer') }}">Create an offer</a>
                        </li>
                        @guest
                        <li>
                            <a href="{{ route('wallet') }}">WALLET</a>
                        </li>
                        @else
                        <li>
                            <a href="{{ route('user.home') }}">DASHBOARD</a>
                        </li>
                        <li>
                            <a href="{{ route('user.wallet') }}">WALLET</a>
                        </li>

                        @endguest

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">HELP
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('page',['slug'=>'f-a-q']) }}">F.A.Q</a>
                                </li>
                                <li>
                                    <a href="#">Support forum</a>
                                </li>
                            </ul>
                        </li>
                        @guest
                        <li>
                            <a href="{{ route('login') }}">LOGIN
                                <i class="fa fa-sign-in" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}">CREATE ACCOUNT
                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                            </a>
                        </li>
                        @else
                        <li class="dropdown account-dropdown sub-menu">
                            <a href="" class="dropdown-toggle noleftpadding sf-with-ul" style="padding-left: 0 !important;" role="button" aria-expanded="false">
                                <div>
                                    <img class="pull-left header-user-avatar" src="{{ asset('images/avatar-thumb.png') }}">
                                    <div class="user-passport-info">
                                        <div>{{ Auth::User()->name }}</div>
                                        <div id="user-btc-balance">
                                            @php $cubalance = Blockchain::getSingleAccount(Auth::user()->wallet->xpub); @endphp {{ bcdiv($cubalance->balance,'100000000',8)
                                            }}
                                            <i class="fa fa-bitcoin"></i>
                                        </div>
                                    </div>
                                    <i class="fa fa-cog"></i>
                                    <div class="clear"></div>
                                </div>
                            </a>
                            <ul role="menu">
                                <li class="submenu">
                                    <a href="{{ route('user.profile') }}">Profile</a>
                                </li>
                                <li class="submenu">
                                    <a href="{{ route('user.settings') }}">Settings</a>
                                </li>
                                <li class="submenu">
                                    <a href="{{ route('user.trades') }}">Completed Trades</a>
                                </li>
                                <li class="submenu">
                                    <a href="">Contacts</a>
                                </li>
                                <li class="submenu">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>

                            </ul>
                        </li>
                        <div class="notification-box">
                            <a href="">
                                <i class="fa fa-bell"></i>
                            </a>
                            <div class="notification-content">
                                <div class="notification-title">
                                    <h4>Notifications</h4>
                                    <a class="heading-sublink pull-right" href="https://paxful.com/account/notifications">View All</a>
                                </div>
                            </div>
                        </div>
                        @endguest
                    </ul>

                </div>
            </div>
        </nav>
        <!--nav design end hear-->

        <noscript>
            &lt;h2 class="text-center topmargin-sm"&gt;Please enable JavaScript to use Paxful website!&lt;/h2&gt;
        </noscript>
        <script>
            if (!navigator.cookieEnabled) {
                document.write('<h2 class="text-center topmargin-sm">Please enable Cookies to use Paxful website!</h2>');
            }
        </script>