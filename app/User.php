<?php

namespace App;

use App\Wallet;
use App\Trade;
use App\Offer;
use App\Walletaddress;
use App\Feedback;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;
    use \HighIdeas\UsersOnline\Traits\UsersOnlineTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $dates = [
        'last_seen'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }
    public function walletaddress()
    {
        return $this->hasMany(Walletaddress::class);
    }

    public function offer()
    {
        return $this->hasMany(Offer::class,'user_id');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'feedback_user_id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    public function trade()
    {
        return $this->hasMany(Trade::class, 'trade_author');
    }

    

}
