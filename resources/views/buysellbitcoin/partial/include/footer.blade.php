<!--footer design start hear-->
<div class="container-fluid last_footer_fluid">
    <div class="container">
        <div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="last_footerL">
                    <p>Copyright © 2018 All Rights Reserved by Paxful Inc</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="last_footerR">
                    <p>
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>help@paxful.com</p>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12  p_tag">
                <p>Paxful Inc. has no relation to MoneyGram, Western Union, Payoneer, Paxum, Paypal, Amazon, OkPay, Payza, Walmart,
                    Reloadit, Perfect Money, WebMoney, Google Wallet, BlueBird, Serve, Square Cash, NetSpend, Chase QuickPay,
                    Skrill, Vanilla, MyVanilla, OneVanilla, Neteller, Venmo, Apple, ChimpChange or any other payment method.
                    We make no claims about being supported by or supporting these services. Their respective wordmarks and
                    trademarks belong to them alone.</p>
            </div>
        </div>
    </div>
</div>
<!--footer design end hear-->

@yield('modal')

</div>
<!--app end hear-->
<script>
    var __baseUrl = "{{url('/')}}"
</script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>


<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


<script src="{{ asset('js/spin.min.js') }}"></script>

<script src="{{ asset('js/ladda.min.js') }}"></script>
<script src="{{ asset('js/ion.rangeSlider.js') }}"></script>
<script src="{{ asset('js/money.min.js') }}"></script>
<script src="{{ asset('js/accounting.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2.2.0/src/js.cookie.min.js"></script>

<script src="{{ asset('js/custom.js') }}"></script>
<script>
    
</script>



@yield('pagejs')

@yield('push_live')

</body>

</html>