<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public static function FindBySlug($slug)
    {
       return static::where('slug', $slug)->first();
    }
}
