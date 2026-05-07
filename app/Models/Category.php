<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug', 'icon', 'description', 'is_active', 'order'
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the businesses for the category.
     */
    public function businesses()
    {
        return $this->hasMany(Business::class);
    }
}
