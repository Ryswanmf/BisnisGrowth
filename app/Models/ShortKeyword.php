<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortKeyword extends Model
{
    protected $fillable = ['title', 'description', 'is_active'];

    /**
     * The articles that belong to the short keyword.
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
