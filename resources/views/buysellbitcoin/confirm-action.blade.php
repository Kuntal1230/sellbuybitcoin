@extends('buysellbitcoin.partial.master') 

@section('content')
    <div class="container-fluid online_sell_buyer_fluid">
		<div class="container">
			<div class="Confirm_div">
				<h1 class="Confirm_h1">{{ $data['header'] }}</h1>
				<strong>{{ $data['msg'] }}</strong>
			</div>
			<div class="confirm_button_div">
				<a href="{{ $data['action_url'] }}" class="btn btn-primary"><i class="fa fa-check"></i> Yes , Confirm</a>
				<a href="" class="btn btn-outline-secondary confirm_row_button2"><i class="fa fa-times"></i> Return</a>

			</div>

			
			
		</div>
	</div>

@endsection