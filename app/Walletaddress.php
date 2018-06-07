<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Walletaddress extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','receiveAddress',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
