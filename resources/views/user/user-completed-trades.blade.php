@extends('buysellbitcoin.partial.master') @section('content')
<!--account_col_L design start hear-->
<div class="container-fluid contacts_fluid">
    <div class="container">
        <div class="contacts_top">
            <div class="col-lg-4 col-md-4 col-xs-12">
                <h2 class="contacts_h2">Trade History</h2>
                <p class="contacts_p">All your trades</p>
            </div>
            <div class="col-lg-8 col-md-8 col-xs-12">
                <div class="contacts_col_R">
                    <ul class="Dashboard_ul pull-right">
                        <li class="Dashboard_li">
                            <a class="Dashboard_a" href="#">Dashboard /</a>
                        </li>
                        <li class="Dashboard_li">
                            <a class="Dashboard_a" href="#">Settings /</a>
                        </li>
                        <li class="Dashboard_li">
                            <a class="Dashboard_a" href="#">Public profile /</a>
                        </li>
                        <li class="Dashboard_li">
                            <a class="Dashboard_a" href="#">Trust list</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


    </div>
</div>









<div class="container-fluid trades_fluid">
    {{-- <div class="container"> --}}
        <div class="trades">
            <div class="trades_all_div">
                <ul class="trades_all_ul">
                    <li class="trades_all_li trades_all_li_bg">
                        <a class="trades_all_a active" href="#">All</a>
                    </li>
                    <li class="trades_all_li">
                        <a class="trades_all_a" href="#">Buy</a>
                    </li>
                    <li class="trades_all_li">
                        <a class="trades_all_a" href="#">Sell</a>
                    </li>
                    <li class="trades_all_li">
                        <a class="trades_all_a" href="#">Successful</a>
                    </li>
                    <li class="trades_all_li">
                        <a class="trades_all_a" href="#">Cancelled</a>
                    </li>
                    <li class="trades_all_li">
                        <a class="trades_all_a" href="#">Dispute</a>
                    </li>
                </ul>
            </div>

            <div class="trades_form_div">
                <form class="form-inline trades_form" action="/action_page.php">
                    <div class="form-group trades_input_div">
                        <label class="trades_form_label" for="email">Start date:</label>
                        <input type="email" class="form-control trades_form_input" id="email" placeholder="" name="email">
                    </div>
                    <div class="form-group trades_input_div">
                        <label class="trades_form_label" for="email">End date:</label>
                        <input type="email" class="form-control trades_form_input" id="email" placeholder="" name="email">
                    </div>

                    <button type="submit" class="btn btn-default trades_form_button1">Filter</button>
                    <button type="submit" class="btn btn-default trades_form_button2">Emport trades to CSV</button>
                </form>
            </div>

            <div class="trades_h2_div">
                <h2 class="trades_h2">Successful trades on current page: 0 out of 0 =
                    <span class="trades_h2_span"> 0%</span>
                </h2>
                <h2 class="trades_h2">Successful trades turnaround: total 0 BTC.</h2>
            </div>
        </div>


    {{-- </div> --}}
</div>



<!--account_col_L design start hear-->
<div class="container-fluid account_fluid trades_account_fluid">
    {{-- <div class="container"> --}}
        <div class="acount_col_R trades_acount_col_R">
            <div class="Active_div2 trades_Active_div2">
                <table class="Active_table">
                    <tr class="Active_tr2">
                        <th class="Active_th2">Type</th>
                        <th class="Active_th2">Amount</th>
                        <th class="Active_th2">In bitcoin</th>
                        <th class="Active_th2">Rate</th>
                        <th class="Active_th2">Fee</th>
                        <th class="Active_th2">Method</th>
                        <th class="Active_th2">Partner</th>
                        <th class="Active_th2">Status</th>
                        <th class="Active_th2">Completed</th>
                        <th class="Active_th2">Trade</th>
                        <th class="Active_th2">Offer</th>
                    </tr>

                </table>
            </div>
        </div>
    {{-- </div> --}}
</div>
<!--account_col_L design start hear-->
@endsection