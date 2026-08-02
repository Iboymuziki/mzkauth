<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;


#[Fillable([
    'facebook_url',
    'instagram_url',
    'linkedin_url',
    'twitter_url',
])]
class SiteSocialLink extends Model
{
    //
}
