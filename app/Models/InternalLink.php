<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternalLink extends Model
{
    protected $fillable = ['keyword', 'url', 'limit', 'is_active'];
}
