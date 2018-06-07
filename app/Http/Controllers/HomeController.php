<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Offer;
use App\Page;
use App\Currency;
use App\Country;
use DB;
use IP2LocationLaravel;
use App\Ip2location;
use App\Paymentmethod;
use App\Trade;
use Illuminate\Support\Facades\Auth;
use Nahid\Talk\Facades\Talk;
use App\Feedback;

class HomeController extends Controller
{
    protected $authUser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $authUser = Auth::user()->id;
            Talk::setAuthUserId($authUser);
            return $next($request);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        return view('buysellbitcoin.home',compact('countries'));
    }

    public function Page($slug)
    {
       $page = Page::FindBySlug($slug);
       return $page;
    }

    public function BuySell()
    {
        $buyoffers = Offer::FindByType('sell');
        $selloffers = Offer::FindByType('buy');
        $countries = Country::all();
        return view('buysellbitcoin.buy-sell',compact('buyoffers','selloffers','countries'));
    }

    public function SingleOffer($offer_slug)
    {
        $offer = Offer::findByOfferSlug($offer_slug);
        // $offer = Offer::where('offer_id',$offer_id)->
        // dd($offer);
        return view('buysellbitcoin.single-offer',compact('offer'));
    }

    public function CreateOfferForm()
    {
        $countries = Country::all();
        $paymentmethods = Paymentmethod::all();
        return view('buysellbitcoin.create-offer',compact('countries','paymentmethods'));
    }

    public function wallet()
    {
        return view('buysellbitcoin.wallet');
    }

    public function StartTrade(Request $request)
    {
        $request->validate([
            'amount_fiat' => 'required'
        ]);
        $trade = Trade::updateOrCreate([
            'slug' =>  $request->trade_slug,
        ],
        [            
            'offer_id'      =>  $request->offer_id,
            'offer_author'  =>  $request->offer_author,
            'trade_author'  =>  Auth::user()->id,
            'amount_fiat'   =>  $request->amount_fiat,
            'amount_btc'    =>  $request->amount_btc,
            'exchange_rate' =>  $request->exchange_rate,
            'payment_status'=>  '0',
            'trade_status'  =>  '1'
        ]);
        $id = $request->offer_author;
        $conversations = Talk::getMessagesByUserId($id, 0, 20);
        $user = '';
        $messages = [];
        if(!$conversations) {
            $user = User::find($id);
        } else {
            $user = $conversations->withUser;
            $messages = $conversations->messages;
        }
        return view('buysellbitcoin.trade',compact('trade','messages','user'));
    }

    public function ConfirmAction(Request $request)
    {
        $data =[
            'header' => $request->header,
            'msg' => $request->msg,
            'action_url' => $request->action_url,
        ];
       return view('buysellbitcoin.confirm-action',compact('data'));
    }

    public function CancelTrade($slug)
    {
       $trade = Trade::where('slug', $slug)->first();
       $trade->trade_status = '0';
       $trade->canceled_by = '0';
       $trade->save();

       $id =  $trade->offer_author;
        $conversations = Talk::getMessagesByUserId($id, 0, 20);
        $user = '';
        $messages = [];
        if(!$conversations) {
            $user = User::find($id);
        } else {
            $user = $conversations->withUser;
            $messages = $conversations->messages;
        }
       return view('buysellbitcoin.trade-cancel',compact('trade','messages','user'));
    }

    public function CancelTradeBytime(Request $request)
    {
        $slug = $request->slug;
        $trade = Trade::where('slug', $slug)->first();
        $trade->trade_status = '0';
        $trade->canceled_by = '1';
        $trade->save();
    }

    public function LeaveFeedback(Request $request)
    {
        if ($request->ratting=='positive') {            
            $identifire = '+';
            $ratting = '1';
        } else if($request->ratting=='negative') {
            $identifire = '-';
            $ratting = '1';
        }else{
            $identifire = '';
            $ratting = '0';
        }
        
        $feedback = new Feedback;
        $feedback->user_id =$request->user_id;
        $feedback->feedback_user_id =$request->feedback_user_id;
        $feedback->offer_id =$request->offer_id;
        $feedback->identifire =$identifire;
        $feedback->ratting =$ratting;
        $feedback->mesage =$request->message;
        $feedback->save();
        return back();
    }

    public function ViewTrade($slug)
    {
        $trade = Trade::where('slug', $slug)->first();
        $id = $trade->offer_author;
        $conversations = Talk::getMessagesByUserId($id, 0, 20);
        $user = '';
        $messages = [];
        if(!$conversations) {
            $user = User::find($id);
        } else {
            $user = $conversations->withUser;
            $messages = $conversations->messages;
        }
        return view('buysellbitcoin.trade-info', compact('trade','messages','user'));
    }

}
