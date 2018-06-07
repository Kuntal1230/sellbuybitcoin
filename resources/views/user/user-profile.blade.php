@extends('buysellbitcoin.partial.master')

@section('content')
    <!--account_col_L design start hear-->
	<div class="container-fluid profile_fluid">
		<div class="container">
			<div class="col-lg-3 col-md-3 col-xs-12 col1">
				<div class="profile_col_L">
					
					<img class="user_img" src="{{ asset('images/default-avatar.svg') }}">
					<div class="Verifications_div">
						<ul class="Verifications_ul">
							<li class="header_li">Verifications</li>
							<li class="Verifications_li"> <i class="fa fa-envelope-o Verifications_i" aria-hidden="true"></i> Email not verified </li>
							<li class="Verifications_li"> <i class="fa fa-mobile Verifications_i" aria-hidden="true"></i> Phone not verified </li>
							<li class="header_li">Info</li>
							<li class="Verifications_li">0 Trade partners</li>
							<li class="Verifications_li">0 Trades</li>
							<li class="Verifications_li">0 BTC Trade volume</li>
							<li class="Verifications_li">Trusted by 0 people</li>
							<li class="Verifications_li">Blocked by 0 people </li>
							<li class="Verifications_li">Joined 3 weeks ago</li>
						</ul>

					</div>
					
				</div>
			</div>
			<div class="col-lg-9 col-md-9 col-xs-12 col1">
				<div class="profile_col_R">
					<div class="fake_div">
						<div class="col-lg-3 col-md-3 col-xs-12 col1">
							<h2 class="fake_h2">{{ Auth::user()->name }}</h2>
						</div>

						<div class="col-lg-9 col-md-9 col-xs-12 col1">
							<div class="profile_media_div">
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

							<div class="Seen">
								<div class="col-lg-4 col-md-4 col-xs-12 Seen_col_4">
									@if (Auth::user()->isOnline())
									<span class="Seen_span1"></span>									
									<h5 class="Seen_h5">Seen just now</h5>
									@else
									<span class="Seen_span1"></span>									
									<h5 class="Seen_h5">{{ diffForHumans(Auth::user()->last_seen) }}</h5>
									@endif
									
								</div>
								<div class="col-lg-4 col-md-4 col-xs-12 Seen_col_42">
									<h2 class="Seen_h2"> + 0</h2>
									<h5 class="Seen_h5">Positive reputation</h5>
								</div>
								<div class="col-lg-4 col-md-4 col-xs-12 Seen_col_4">
									<div class="div2">
										<span class="Seen_span2"> - 0 </span>
										<h5 class="Seen_h52">Neutral reputation</h5>
									</div>
									<div class="div2">
										<span class="Seen_span3"> - 0 </span>
										<h5 class="Seen_h52">Negative reputation</h5>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="Offers_div">
						<ul class="Offers_ul">
							<li class="header_li">Offers</li>
							<li class="Offers_li"> User has no active offers </li>
							<li class="header_li">Feedback (0)</li>
							<li class="Offers_li">No feedback yet
								
					
							</li>
							
						</ul>
						
					</div>

						
				</div>
			</div>
		</div>
	</div>	
@endsection