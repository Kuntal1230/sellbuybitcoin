<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallet;
use App\User;
use Blockchain;
use Illuminate\Support\Facades\Auth;
use App\Walletaddress;
use Illuminate\Support\Facades\Hash;
use App\Offer;
use Illuminate\Support\Facades\Session;
use App\Country;
use App\Securitiquestion;
use App\Profile;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function userHome()
    {
        
        return view('user.user-home',compact(''));
    }

    public function userWallet()
    {
            $xpub =  Auth::user()->wallet->xpub;

            $walletinfo =  Blockchain::getSingleAccount($xpub);

        return view('user.user-wallet',compact('walletinfo'));
    }

    public function userProfile()
    {
        return view('user.user-profile');
    }

    public function userSettings()
    {
        $countreis = Country::all();
        $questions = Securitiquestion::all();
        return view('user.user-settings',compact('countreis','questions'));
    }

    public function UpdateProfile(Request $request)
    {
        // return $request->all();
        $profile = User::findOrFail(Auth::user()->id);
        $profile->firstname = $request->fname;
        $profile->lastname = $request->lname;
        $profile->bio = $request->bio;
        $profile->save();
        return back();
    }

    public function userTrades()
    {
        return view('user.user-completed-trades');
    }

    public function SendBitcoin(Request $request)
    {
        return $request->all();
    }

    public function StoreOffer(Request $request)
    {

        $request->validate([
            'type' => 'required',
            'currency' => 'required',
            'payment_method' => 'required',
            'offer_country' => 'required',
            'margin' => 'required',
            'range_min' => 'required',
            'range_max' => 'required',
            'payment_window' => 'required',
            'offer_terms' => 'required',
            'trade_details' => 'required',
        ]);

        $offer= new Offer;
        $offer->offer_slug = mt_rand(10000000,99999999);
        $offer->user_id = Auth::user()->id;
        $offer->type = $request->type;
        $offer->currency_code = $request->currency;
        $offer->paymentmethod_id = $request->payment_method;
        $offer->paymentmethod_label = $request->payment_method_label;
        $offer->country_code = $request->offer_country;
        $offer->margin = $request->margin;
        $offer->offer_price = $request->offer_price;
        $offer->min_ammount = $request->range_min;
        $offer->max_ammount = $request->range_max;
        $offer->payment_window = $request->payment_window;
        $offer->offer_terms = $request->offer_terms;
        $offer->trade_instruction = $request->trade_details;
        $offer->verified_email = $request->require_verified_email;
        $offer->verified_phone = $request->require_verified_phone;
        $offer->trusted_user = $request->show_only_trusted_user;
        $offer->past_trades = $request->require_min_past_trades;
        $offer->save();
        foreach ($request->tags as $tag) {
        $offer->tag()->create([
            'offer_id' =>  $offer->id,
            'name' => $tag
        ]);
        }
        Session::flash('message', 'Trade Add Successfull!'); 
        Session::flash('alert-class', 'alert-success');
        return back();
        
    }
    
    public function StoreAddress()
    {
        $xpub =  Auth::user()->wallet->xpub;

        $address = Blockchain::getSingleAccount($xpub);

        $reciveaddress = Walletaddress::updateOrCreate(            
            ['receiveAddress' => $address->receiveAddress],
            ['user_id' => Auth::user()->id]
        );
  
    }

    public function PrepareSendFrom(Request $request)
    {
        $btcAmount = $request->btcAmount;
        $address = $request->address;
        $userPassword = $request->userPassword;
        $id = Auth::user()->id;
        $user = User::find($id);
        $hashedPassword = $user->password;
        
        if (Hash::check($userPassword, $hashedPassword)) {
           return "matched";
        }else{
            return "notmatched";
        }
        

    }

    public function ConfirmSendFrom(Request $request)
    {
        

        try {
            $cal =$request->ammount*100000000;
            $guid="c6cd9676-4e91-4bc4-921a-e5327b623fdd";
            $main_password="@gupta1230@";
            $second_password="";
            $amount = "$cal";
            $address = "$request->to_address";
            $recipients = urlencode('{
                "'.$address.'": '.$amount.'
            }');
            $from = "$request->form_address_index";
            $fee_per_byte ="2";
            $json_url = "http://localhost:3000/merchant/$guid/sendmany?password=$main_password&second_password=$second_password&recipients=$recipients&from=$from&fee_per_byte=$fee_per_byte";
            $json_data = file_get_contents($json_url);
            $json_feed = json_decode($json_data);
        dd($json_feed);
            $message = $json_feed->message; 
            $txid = $json_feed->tx_hash; 
            $notice = $json_feed->error; 
            return $notice;
            
          }
          
          //catch exception
          catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
          }
    }


}
