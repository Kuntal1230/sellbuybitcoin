<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','label','xpriv','xpub',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
