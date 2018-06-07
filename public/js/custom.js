$(document).ready(function () {
    "use strict";        

    var conceptName = $('#fiat_currency_id :selected').val();    
    Cookies.set('fromCurrency', conceptName);
    var current_btc_rate;
    var current_usd;
    var fromCurrency = Cookies.get('fromCurrency');
    $('#fiat_currency_id').change(function () {
        Cookies.set('fromCurrency', $(this).val());
    });



    // initialize loda content
    Ladda.bind('.ladda-button');

    // initialize ion range content
    var $range = $("#amount_range");
    $range.ionRangeSlider({
        type: "double",
        grid: false,
        min: 0,
        max: 10000,
        from: 0,
        to: 10000,
        prefix: "$"
    });
    $range.on("change", function () {
    var $this = $(this),
        from = $this.data("from"),
        to = $this.data("to");

        $('#range_min').val(from);
        $('#range_max').val(to);
    });

    
    $('#range_min').keyup(function(){
        var from = $(this).val();
        var slider = $("#amount_range").data("ionRangeSlider");
            slider.update({
            from: from
            });
        
    })
    $('#range_max').keyup(function(){
        var to = $(this).val();
        var slider = $("#amount_range").data("ionRangeSlider");
            slider.update({
            to: to
            });
        
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var session = $('#sessioncheck').val();
    if (session!=null) {
        var time = 20000;
        $(function poll(){
                //this makes the setTimeout a self run function it runs the first time always
                setTimeout(function(){
                    $.ajax({
                        url:'/storeaddress', 
                        type: "POST",
                        success: function()
                        {
                            console.log("Ajax Processed");
                        },complete: poll
                    });
                },time);
        //end poll function
        });
        
    }

});

// Load exchange rates data via AJAX:
$.getJSON('https://openexchangerates.org/api/latest.json?app_id=a483dc1e00144706bc68387edecab144',
    function (data) {
        // Check money.js has finished loading:
        if (typeof fx !== "undefined" && fx.rates) {
            fx.rates = data.rates;
            fx.base = data.base;
        } else {
            // If not, apply to fxSetup global:
            var fxSetup = {
                rates: data.rates,
                base: data.base
            }
        }
        current_btc_rate = window.fx.convert(1, {
            from: "BTC",
            to: "USD"
        });

        function BtcRateByCurrency(currency_code) {
            var btc_rate = window.fx.convert(1, {
                from: "BTC",
                to: currency_code
            });
            return btc_rate;
        }

        function BtcToAny(inputammount) {
            var btc_to_any=  window.fx.convert(inputammount, {
                from: "BTC",
                to: Cookies.get('fromCurrency')
            });

            return btc_to_any;
        }

        function AnyToBtc(inputammount) {
            var any_to_btc = window.fx.convert(inputammount, {
                from: Cookies.get('fromCurrency'),
                to: "BTC"
            });
            return any_to_btc;
        }

        current_usd = accounting.formatMoney(current_btc_rate);
        $('#current_btc_rate').html(current_usd);      



        $("#ammount").keyup(function () {
            var inputammount = $(this).val();
            var conceptName = $('#fiat_currency_id :selected').val();    
            Cookies.set('fromCurrency', conceptName);
            
            var any_to_btc=AnyToBtc(inputammount);
            $('#btc_amount').val(any_to_btc);
        });

        $("#btc_amount").keyup(function () {
            var inputammount = $(this).val();
            var btc_to_any=BtcToAny(inputammount);
            $('#ammount').val(btc_to_any);
        });

    // wallet page js start

        $(document).ready(function() {
            var curr_balance = $('#curr_balance').html();            
            var to = $('#curr_currency').html();            
            Cookies.set('fromCurrency', to);
            var btc_to_any = BtcToAny(curr_balance);
            $('#curr_local_balance').html(accounting.formatMoney(btc_to_any," "));
            


            $('#sendAvailable').click(function(){
                var availableAmount = $(this).html();
                $('#sendAmount').val(availableAmount);
    
            });
    
            $('#sendAmount').bind("keyup change", function(e){
                var inputammount = $(this).val();
                var sendAvailable = $('#sendAvailable').html();
                
                if (sendAvailable<inputammount) {
                    $('#amount_error').removeClass('hidden');
                    $('#prepare-send-payment-btn').attr("disabled", "disabled");
                }else{
                    $('#amount_error').addClass('hidden');
                    $('#prepare-send-payment-btn').prop("disabled", false);
                    var to = $('#sendCurrencyCode').html();
                    Cookies.set('fromCurrency', to);
                    var btc_to_any = BtcToAny(inputammount);            
                    $('#sendAmountFiat').html(accounting.formatMoney(btc_to_any));
                }
                 
            });

            $("#prepare-send-form").on( "submit", function( event ) {
                event.preventDefault();
                var data = $(this).serialize();
                $.ajax({
                    url:'/preparesendform', 
                    type: "POST",
                    data: data,
                    success: function(data){
                        if (data=='matched') {
                            if ($('#bitcoinaddr').val()=='') {
                                $('#onPrepareSendResponse').css('display', 'block');
                                $('#sendresponseerror').html('Unknown bitcoin address.');
                                $('#prepare-send-payment-btn').removeAttr('data-loading');
                                $('#prepare-send-payment-btn').removeAttr('disabled');
                            }else{
                                $('#first_item').removeClass('active');
                                $('#second_item').addClass('active');
                                $('#prepare-send-payment-btn').addClass('hidden');
                                $('#showOnConfirmStep').css('display', 'block');
                                $('#confirmSendToAddress').html($('#bitcoinaddr').val());
                                $('#to_address').val($('#bitcoinaddr').val());
                                $('#confirmSendAmountCrypto').html($('#sendAmount').val());
                                $('#ammount').val($('#sendAmount').val());
                                $('#confirmSendFiatAmount').html($('#sendAmountFiat').html());
                                $('#onPrepareSendResponse').css('display', 'none');
        
                            }                    
                        }else if(data=='notmatched'){
                            $('#onPrepareSendResponse').css('display', 'block');
                            $('#sendresponseerror').html('Incorrect password');
                            $('#prepare-send-payment-btn').removeAttr('data-loading');
                            $('#prepare-send-payment-btn').removeAttr('disabled');
                        }
                        
                        
                    },
                    error: function (error) {
                        console.log(error)
                    }
                    
                });

              });


            //   $('#confirm-send-form').on( "submit", function( event ){
            //     event.preventDefault();
            //     var from_address = $('#form_address_index').val();
            //     var to_address = $('#confirmSendToAddress').html();
            //     var ammount = $('#confirmSendAmountCrypto').html();
            //     $.ajax({
            //         url:'/confirmsendform', 
            //         type: "POST",
            //         data: {to_address:to_address,ammount:ammount,from_address:from_address},
            //         success: function(data){
            //             console.log(data);
                        

            //         },
            //         error: function (error) {
            //             console.log(error)
            //         }
            //     });
            //   });

              $('#go-back').click(function(){

                $('#first_item').addClass('active');
                $('#second_item').removeClass('active');
                $('#prepare-send-payment-btn').removeClass('hidden');
                $('#showOnConfirmStep').css('display', 'none');
                $('#prepare-send-payment-btn').removeAttr('data-loading');
                $('#prepare-send-payment-btn').removeAttr('disabled');

              });
            
        });       

        
 
    // wallet page js end

    
    // create offer js start
    $(document).ready(function(){
        var user_ip_currency = $('#user_ip_currency').val();
        var current_market_price_by_ip_currency = BtcRateByCurrency(user_ip_currency);
        var current_market_price_by_ip = accounting.formatNumber(current_market_price_by_ip_currency,3);
        $('#btc-current-market-price').html(accounting.formatNumber(current_market_price_by_ip,3));
        console.log(user_ip_currency);
        
        $('#margin').on("keyup change", function(e){

                $('#currency-preloader-img').fadeIn(1000).delay(2000).fadeOut(1000);         
                var margin = $(this).val();
                var currency_code = $('#currency :selected').attr("data-currencycode");
                var current_market_price_by_currency = BtcRateByCurrency(currency_code);
                var current_market_price = accounting.formatNumber(current_market_price_by_currency,3);
                var after_margin_price = ((accounting.unformat(current_market_price)*margin)/100)+accounting.unformat(current_market_price);
                $('#btc-current-market-price').html(accounting.formatNumber(after_margin_price,3));  
                $('#offer_price').val(accounting.unformat(after_margin_price,3));  
                // console.log(current_market_price_by_currency);
                
            });
            
            $('#currency').change(function(){
                var currency_code = $('#currency :selected').attr("data-currencycode");
                $('#fiat-current-currency').html(currency_code);
                console.log(currency_code);
                
            });
    });
    

    
   });

