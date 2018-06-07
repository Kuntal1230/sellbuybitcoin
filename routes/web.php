<?php

Route::get('/','HomeController@index')->name('home');
Route::get('wallet','HomeController@wallet')->name('wallet');
Route::get('buy-sell','HomeController@BuySell')->name('buy-sell');
Route::get('offer/{offer_slug}', 'HomeController@SingleOffer')->name('single.offer');
Route::post('trade', 'HomeController@StartTrade')->name('start.trade');
Route::get('trate/{slug}', 'HomeController@ViewTrade')->name('view.trade');
Route::post('confirm_action', 'HomeController@ConfirmAction')->name('confirm.action');
Route::get('trade/cancel/{slug}', 'HomeController@CancelTrade')->name('cancel.trade');
Route::post('trade/cancel/expirtime', 'HomeController@CancelTradeBytime');
Route::post('trade/leave_feedback/{name}', 'HomeController@LeaveFeedback')->name('leave.feedback');
Route::get('create-offer','HomeController@CreateOfferForm')->name('create.offer');
Route::get('page/{slug}','HomeController@Page')->name('page');


Route::get('create','UserController@StoreAddress');
Route::get('/test','UserController@ConfirmSendFrom');


Auth::routes();
Route::prefix('user')->group(function (){
    Route::get('/home','UserController@userHome')->name('user.home');
    Route::get('/wallet','UserController@userWallet')->name('user.wallet');
    Route::get('/profile','UserController@userProfile')->name('user.profile');
    Route::get('/settings','UserController@userSettings')->name('user.settings');
    Route::get('/trades','UserController@userTrades')->name('user.trades');
    Route::post('/profile','UserController@UpdateProfile')->name('user.updateprofile');

});

Route::post('/storeaddress','UserController@StoreAddress');
Route::post('/preparesendform','UserController@PrepareSendFrom');
Route::post('/confirmsendform','UserController@ConfirmSendFrom')->name('confirmsend');


Route::post('/offer-manager/save','UserController@StoreOffer')->name('user.offersave');

Route::post('/send-bitcoin','UserController@SendBitcoin')->name('user.sendbitcoin');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::get('message/{id}', 'MessageController@chatHistory')->name('message.read');

Route::group(['prefix'=>'ajax', 'as'=>'ajax::'], function() {
   Route::post('message/send', 'MessageController@ajaxSendMessage')->name('message.new');
   Route::delete('message/delete/{id}', 'MessageController@ajaxDeleteMessage')->name('message.delete');
});

Route::get('test', 'MessageController@tests');
