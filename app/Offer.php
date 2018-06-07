<?php

namespace App;

use App\User;
use App\Tag;
use App\Country;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public static function FindByType($type)
    {
       return static::where('type', $type)->get();
    }

    public static function findByOfferSlug($offer_slug)
    {
       return static::where('offer_slug', $offer_slug)->first();
    }

    public function tag()
    {
        return $this->hasMany(Tag::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class,'country_code');
    }
    public function paymentmethod()
    {
        return $this->belongsTo(Paymentmethod::class,'paymentmethod_id');
    }
}
