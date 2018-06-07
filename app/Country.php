<?php

namespace App;

use App\Offer;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
    ];

    public function offer()
    {
        return $this->hasMany(Offer::class);
    }
}
