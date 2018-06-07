<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Message extends Model
{
    protected $fillable = ['message','reciver_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'sender_id');
    }
}
