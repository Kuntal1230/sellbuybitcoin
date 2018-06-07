@extends('buysellbitcoin.partial.master') @section('content')

<!--Buy-bitcoin design start hear-->
<div class="container-fluid baner_fluid ">
	<div class="container">
		<div class="baner">
			<h1>Buy bitcoin</h1>
			<p>MyBitcoinBuySell.com is the best place to buy bitcoin instantly</p>
		</div>
	</div>
</div>
<!--Buy-bitcoin design end hear-->

<!--form design start hear-->

<div class="container search-form-container">
	<div class="row">
		<div class="col-md-12">
			<div class="search-form-wrap">
				<ul class="nav nav-tabs search-form-nav" role="tablist">
					<li role="presentation" class="active">
						<a href="#orange_form_buy" class="tab-buy" aria-controls="orange_form_buy" role="tab" data-toggle="tab" aria-expanded="true">QUICK BUY</a>
					</li>
					<li role="presentation" class="">
						<a href="#orange_form_sell" class="tab-sell" aria-controls="orange_form_sell" role="tab" data-toggle="tab" aria-expanded="false">QUICK SELL</a>
					</li>
				</ul>
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="orange_form_buy">


						<form action="/instant-bitcoins/" class="search-form" method="post">
							<div class="search-form-fields">
								<input id="id_action" name="action" type="hidden" value="buy">
								<div id="div_id_amount" class="form-group">
									<div class="controls ">
										<input class="search-form-amount textinput textInput form-control" id="id_amount" name="amount" placeholder="Amount" type="text">
									</div>
								</div>
								<div id="div_id_currency" class="form-group">
									<div class="controls ">
										<select class="search-form-currency select form-control" id="id_currency" name="currency">
											@if ($current_info)
											<option value="{{ $current_info->currency_code }}" selected>{{ $current_info->currency_name }}</option>
											@endif
											@foreach ($countries as $country)
											<option value="{{ $country->currency_code }}">{{ $country->currency_name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div id="div_id_place_country" class="form-group" style="display: inline-block;">
									<div class="controls ">
										<select class="search-form-place select form-control" id="search-form-place-country" name="place_country">
											@if ($current_info)
											<option value="{{ $current_info->country_code }}" selected>{{ $current_info->country_name }}</option>
											@endif
											@foreach ($countries as $country)
											<option value="{{ $country->country_code }}">{{ $country->country_name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div id="div_id_online_provider" class="form-group">
									<div class="controls ">
										<select class="form-control" id="id_online_provider" name="online_provider">
											
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="controls ">
										<input type="submit" name="find-offers" value="Search" class="btn btn-primary search-form-button" id="submit-id-find-offers">
									</div>
								</div>

							</div>
						</form>

					</div>
					<div role="tabpanel" class="tab-pane" id="orange_form_sell">


						<form action="/instant-bitcoins/" class="search-form" method="post">
							<div class="search-form-fields">
								<input id="id_action" name="action" type="hidden" value="sell">
								<div id="div_id_amount" class="form-group">
									<div class="controls ">
										<input class="search-form-amount textinput textInput form-control" id="id_amount" name="amount" placeholder="Amount" type="text"> </div>
								</div>
								<div id="div_id_currency" class="form-group">
									<div class="controls ">
										<select class="search-form-currency select form-control" id="id_currency" name="currency">
											@if ($current_info)
											<option value="{{ $current_info->currency_code }}" selected>{{ $current_info->currency_name }}</option>
											@endif
											@foreach ($countries as $country)
											<option value="{{ $country->currency_code }}">{{ $country->currency_name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div id="div_id_place_country" class="form-group" style="display: inline-block;">
									<div class="controls ">
										<select class="search-form-place select form-control" id="search-form-place-country" name="place_country">
											@if ($current_info)
											<option value="{{ $current_info->country_code }}" selected>{{ $current_info->country_name }}</option>
											@endif
											@foreach ($countries as $country)
											<option value="{{ $country->country_code }}">{{ $country->country_name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div id="div_id_online_provider" class="form-group">
									<div class="controls ">
										<select class="form-control" id="id_online_provider" name="online_provider">
											
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="controls ">
										<input type="submit" name="find-offers" value="Search" class="btn btn-primary search-form-button" id="submit-id-find-offers">
									</div>
								</div>

							</div>
						</form>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<!--form design end hear-->


<!--Open offers design start hear-->

<div class="container-fluid offers_fluid">
	<div class="container offers_container">

		<!--open using design start hear-->

		<div class="col-lg-12 col-md-12 col-xs-12 open_col">
			<div class="open_site">
				<div class="row">
					<div class="top_ro col-xs-12">
						<h2>Buy bitcoins online in {{ $current_info->country_name }}</h2>
						<span class="pull-right">current bitcoin market price
							<span id="current_btc_rate"> </span> USD</span>
					</div>
				</div>
				<div class="offers-list">
					<table class="table">
						<thead>
							<tr>
								<th>Seller</th>
								<th>Pay with</th>
								<th>Min—Max amount</th>
								<th>Rate per bitcoin</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($buyoffers as $offer) 
								@include('buysellbitcoin.partial.buy',['offer'=>$offer]) 
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="row">
					<div class="top_ro col-xs-12">
						<h2>Sell bitcoins online in {{ $current_info->country_name }}</h2>
					</div>
				</div>
				<div class="offers-list">
					<table class="table">
						<thead>
							<tr>
								<th>Buyer</th>
								<th>Sell for</th>
								<th>Min—Max amount</th>
								<th>Rate per bitcoin <br><small>You can sell any fraction</small></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($selloffers as $offer)
							@include('buysellbitcoin.partial.sell',['offer'=>$offer]) 
							@endforeach	
						</tbody>
					</table>
				</div>
			</div>

			<div class="not_all_offers">
				<h4 class="h4">Not all offers are shown, please select one of the payment option groups to see more ways to buy bitcoin</h4>

				<div class="col-lg-3 col-md-3 col-xs-6 not_all_offers_col">
					<a class="not_all_offers_a" href="#">Gift cards</a>
					<img class="not_all_offers_img" src="images/7.svg">
				</div>
				<div class="col-lg-3 col-md-3 col-xs-6 not_all_offers_col">
					<a class="not_all_offers_a" href="#">Cash deposits</a>
					<img class="not_all_offers_img" src="images/6.svg">
				</div>
				<div class="col-lg-3 col-md-3 col-xs-6 not_all_offers_col">
					<a class="not_all_offers_a" href="#">Online transfers</a>
					<img class="not_all_offers_img" src="images/8.svg">
				</div>
				<div class="col-lg-3 col-md-3 col-xs-6 not_all_offers_col">
					<a class="not_all_offers_a" href="#">Debit/credit cards</a>
					<img class="not_all_offers_img" src="images/9.svg">
				</div>

			</div>
		</div>
		<!--open using design end hear-->


	</div>
</div>
<!--Open offers design end hear-->

@endsection