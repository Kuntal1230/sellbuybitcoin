<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Offer;

class Tag extends Model
{
    protected $fillable = [
        'offer_id', 'name',
    ];
    public function offer()
    {
        return $this->belongsTo()(Offer::class,'offer_id');
    }
}
