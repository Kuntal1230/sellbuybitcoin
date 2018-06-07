<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Offer;
use App\User;

class Trade extends Model
{
    protected $fillable = [
        'slug', 'offer_id', 'offer_author','trade_author', 'amount_fiat', 'amount_btc','exchange_rate','payment_status', 'trade_status',
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id');
    }
    public function tradeauthor()
    {
        return $this->belongsTo(User::class, 'trade_author');
    }

    public function scopeActive($query)
    {
        return $query->where('trade_status', 1);
    }
}
