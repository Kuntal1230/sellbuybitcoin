<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    
}
