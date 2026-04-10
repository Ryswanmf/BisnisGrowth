<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug', 'icon', 'description', 'is_active', 'order'])]
class Category extends Model
{
    /**
     * Get the businesses for the category.
     */
    public function businesses(): HasMany
    {
        return $this->hasMany(Business::class);
    }
}
