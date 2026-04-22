<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['article_id', 'name', 'content', 'is_approved', 'ip_address'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
