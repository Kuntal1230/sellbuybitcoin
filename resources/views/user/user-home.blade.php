@extends('buysellbitcoin.partial.master') @section('content')
<!--loging_baner design start hear-->
<div class="container-fluid Lo_baner_fluid ">
	<div class="container">
		<div class="baner">
			<div class="col-lg-6 col-md-6 col-xs-12">
				<div class="baner_l">
					<div class="img_D">
						<i class="fa fa-user baner_l_i" aria-hidden="true"></i>
					</div>

					<div class="fake_D">
						<h4 class="baner_l_h4">{{ Auth::User()->name }}</h4>
						<h4 class="baner_l_h4">@php $cubalance = Blockchain::getSingleAccount(Auth::user()->wallet->xpub); @endphp {{ bcdiv($cubalance->balance,'100000000',8)
						}} BTC</h4>
						<h6 class="baner_l_h6">
							<span class="span_1">+ {{ Auth::User()->feedback->where('identifire','+')->count() }}</span>
							<span class="span_2">/</span>
							<span class="span_3">- {{ Auth::User()->feedback->where('identifire','-')->count() }}</span>
						</h6>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-xs-12 col_r">
				<div class="col-lg-3 col-md-3 col-xs-6 border_r">
					<a href="{{ route('buy-sell') }}">
						<div class="baner_R_i1 common">
							<i class="fa fa-btc baner_R_icin-1" aria-hidden="true"></i>
						</div>
						<h5 class="baner_R_h5">BuyBitcoin</h5>
					</a>
					
				</div>

				<div class="col-lg-3 col-md-3 col-xs-6 border_r 2aa">
					<a href="{{ route('user.wallet') }}">
						<div class="baner_R_i2 aa_d common">
							<i class="fa fa-money baner_R_icin-2" aria-hidden="true"></i>
						</div>
						<h5 class="baner_R_h5">Send&Receive</h5>
					</a>
				</div>
				<div class="col-lg-3 col-md-3 col-xs-6 border_r">
					<div class="baner_R_i2 common">
						<i class="fa fa-shield baner_R_icin-2" aria-hidden="true"></i>
					</div>
					<h5 class="baner_R_h5">2FASecurity</h5>
				</div>
				<div class="col-lg-3 col-md-3 col-xs-6">
					<div class="baner_R_i2 common">
						<i class="fa fa-life-ring baner_R_icin-2" aria-hidden="true"></i>
					</div>
					<h5 class="baner_R_h5">Help</h5>
				</div>


			</div>
		</div>
	</div>
</div>
<!--loging_baner design end hear-->











<!--Confirm design start hear-->

<div class="container-fluid Confirm_fluid">
	<div class="container">
		<div class="ul_div">
			<ul class="ul_tag">
				<li class="li_tag">
					<a class="a_tag" href="#">
						<i class="fa fa-envelope-o i_tag" aria-hidden="true"></i>
					</a>
					<h5 class="h5_tag">Confirm Email</h5>
				</li>
				<li class="li_tag">
					<a class="a_tag" href="#">
						<i class="fa fa-mobile i_tag Phone" aria-hidden="true"></i>
					</a>
					<h5 class="h5_tag">Verify Phone</h5>
				</li>
				<li class="li_tag">
					<a class="a_tag active" href="#">

						<i class="fa fa-user-o i_tag" aria-hidden="true"></i>
					</a>
					<h5 class="h5_tag active_h5">Update Username</h5>
				</li>
				<li class="li_tag">
					<a class="a_tag" href="#">

						<i class="fa fa-smile-o i_tag" aria-hidden="true"></i>
					</a>
					<h5 class="h5_tag">Set Profile Picture</h5>
				</li>
				<span class="span_tag"></span>
				<li class="li_tag">
					<a class="a_tag" href="#">
						<i class="fa fa-shield i_tag" aria-hidden="true"></i>
					</a>
					<h5 class="h5_tag">Enable 2FA</h5>
				</li>
				<span class="span_tag"></span>
			</ul>
		</div>
	</div>
</div>

<!--Confirm design end hear-->




<!--Active design start hear-->
<div class="container-fluid active_fluid">
	<div class="container">
		<div class="top_d">
			<div class="top">
				<h3 class="top_h3">Active Trades</h3>
			</div>
			@if (Auth::user()->trade()->Active()->get()->count())
				<div class="table-responsive">
					<table class="offers-table table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Created at</th>
								<th>Seller</th>
								<th>Amount (BTC)</th>
								<th>Amount (fiat)</th>
								<th>Type</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach (Auth::user()->trade()->Active()->get() as $trade)

								<tr>
									<td>{{ $trade->slug }}</td>
									<td>{{ $trade->created_at }}</td>
									<td>{{ $trade->tradeauthor->name }}</td>
									<td>{{ $trade->amount_btc }} BTC</td>
									<td>{{ $trade->amount_fiat }} {{ $trade->offer->country->currency_code }}</td>
									<td>{{ $trade->offer->paymentmethod->name }}</td>
									<td>@if ($trade->payment_status==0) Waiting for paymment @else Paymment done @endif </td>
									<td><a href="{{ route('view.trade',['slug'=>$trade->slug]) }}">View message</a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			@else
				<h4 class="top_h4">No active trades.
					<a class="top_atag" href="#">Get out there and find an offer you can't refuse</a>
				</h4>
			@endif
			
			<a class="top_a pull-right" href="#">View all past trades</a>
		</div>
		<div class="col-lg-9 col-md-9 col-xs-12">
			<div class="active_L">
				<div class="my_offer">My Offers</div>
				@if (Auth::user()->offer)				
					<div class="table-responsive">
						<table class="offers-table table table-hover">
							<thead>
								<tr>
									<th>On/Off</th>
									<th>Type</th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th>Avg release</th>
								</tr>
							</thead>
							<tbody>
								@foreach (Auth::user()->offer as $offer)

									<tr class="offer_tr">
										<td class="offer-active-toggle">
											<div class="slideThree">  
												<input type="checkbox" value="None" id="slideThree" name="check" checked />
												<label for="slideThree"></label>
											</div>
										</td>
										<td class="text-uppercase">{{ $offer->type }}</td>
										<td>
											<a href="" title="View your offer" class="button button-border button-mini button-dark button-rounded uppercase nomargin">View</a>
										</td>
										<td>
											<a href="" title="Edit your offer" class="button button-border button-mini button-dark button-rounded uppercase nomargin">Edit</a>
										</td>
										<td>
											{{ number_format($offer->offer_price,2) }}
											<span class="denomination">{{ $offer->country->currency_code }}</span>
											<strong>+{{ $offer->margin }}%</strong>
										</td>
										<td>
											{{ $offer->min_ammount.'-'.$offer->max_ammount }}
											<span class="denomination">{{ $offer->country->currency_code }}</span>
										</td>
										<td>
											{{ $offer->paymentmethod->name }}
											<br>
											<div class="tags">
												@if ($offer->tag)
													@foreach ($offer->tag as $tag)
														<span class="offer-tag">{{ $tag->name }}</span>
													@endforeach
												@endif
												
											</div>
										</td>
										<td>
											<span class="label label-info">New</span>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				@else
					
					<div class="create">
						<a class="create_a" href="#">Create your offer</a>
					</div>
				@endif
				
				

				<div class="account">
					<div class="col-lg-6 col-md-6 col-xs-12 account_activity">Account Activity</div>
					<div class="col-lg-6 col-md-6 col-xs-12 Transactions">
						<a class="Transactions_a" href="#">Transactions</a>
						<i class="fa fa-question-circle-o Transactions_i" aria-hidden="true"></i>
					</div>
					<ul class="account_ul">
						<li class="account_li">
							<div class="account_li_div">
								<div class="account_i_div">
									<i class="fa fa-list-ul account_i" aria-hidden="true"></i>

								</div>
								<span class="account_span1">User login</span>
								<span class="pull-right account_span2">2 hours ago
								</span>
							</div>
						</li>
						<li class="account_li">
							<div class="account_li_div">
								<div class="account_i_div">
									<i class="fa fa-list-ul account_i" aria-hidden="true"></i>

								</div>
								<span class="account_span1">User login</span>
								<span class="pull-right account_span2">2 hours ago
								</span>
							</div>
						</li>
						<li class="account_li">
							<div class="account_li_div">
								<div class="account_i_div">
									<i class="fa fa-list-ul account_i" aria-hidden="true"></i>

								</div>
								<span class="account_span1">User login</span>
								<span class="pull-right account_span2">2 hours ago
								</span>
							</div>
						</li>
						<li class="account_li">
							<div class="account_li_div">
								<div class="account_i_div">
									<i class="fa fa-list-ul account_i" aria-hidden="true"></i>

								</div>
								<span class="account_span1">User login</span>
								<span class="pull-right account_span2">2 hours ago
								</span>
							</div>
						</li>
						<li class="account_li">
							<div class="account_li_div">
								<div class="account_i_div">
									<i class="fa fa-list-ul account_i" aria-hidden="true"></i>

								</div>
								<span class="account_span1">User login</span>
								<span class="pull-right account_span2">2 hours ago
								</span>
							</div>
						</li>
						<li class="account_li">
							<div class="account_li_div">
								<div class="account_i_div">
									<i class="fa fa-list-ul account_i" aria-hidden="true"></i>

								</div>
								<span class="account_span1">User login</span>
								<span class="pull-right account_span2">2 hours ago
								</span>
							</div>
						</li>
						<li class="account_li">
							<div class="account_li_div">
								<div class="account_i_div">
									<i class="fa fa-list-ul account_i" aria-hidden="true"></i>

								</div>
								<span class="account_span1">User login</span>
								<span class="pull-right account_span2">2 hours ago
								</span>
							</div>
						</li>
					</ul>
					<div class="account_bottom">
						<a class="bottom_a1" href="#">All activity</a>
						<a class="pull-right bottom_a2" href="#">All transactions</a>
					</div>

				</div>
			</div>

		</div>
		<div class="col-lg-3 col-md-3 col-xs-12 col_3">
			<div class="active_R">
				<div class="past">
					<div class="past_h4_div">
						<h4 class="past_h4">Past Trades</h4>
						<p class="past_p">No trades yet</p>
					</div>
					<div class="past_h4_div">
						<h4 class="past_h4">Feedback received</h4>
						<p class="past_p">No feedback yet</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--Active design end hear-->

@endsection