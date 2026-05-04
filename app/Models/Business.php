<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'user_id', 'name', 'slug', 'tagline', 'description', 'category_id',
    'logo', 'cover_image', 'phone', 'whatsapp', 'email', 'website',
    'address', 'city', 'province', 'instagram', 'facebook', 'tiktok', 'youtube',
    'theme_color', 'is_active', 'view_count', 'click_count',
    'meta_title', 'meta_description'
])]
class Business extends Model
{
    /**
     * Get the user that owns the business.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that the business belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the links for the business.
     */
    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    /**
     * Get the page views for the business.
     */
    public function pageViews(): HasMany
    {
        return $this->hasMany(PageView::class);
    }
}
