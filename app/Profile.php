<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $fillable = [
        'title', 'description', 'profile_pic_url', 'website',
    ];
}
