<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    protected $fillable = [
        'logo', 'about_text', 'email', 'phone', 'address',
        'facebook_url', 'instagram_url', 'twitter_url', 'linkedin_url',
        'copyright_text'
    ];
}
