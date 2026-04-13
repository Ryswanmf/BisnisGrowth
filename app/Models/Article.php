<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'image', 'image_2', 'image_3', 'image_4', 
        'image_alt', 'category_name', 'view_count', 'is_featured', 'is_published', 
        'published_at', 'meta_title', 'meta_description', 'focus_keyword', 'canonical_url'
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    /**
     * Accessor: SEO Title
     * Uses meta_title if available, fallback to title
     */
    protected function seoTitle(): Attribute
    {
        return Attribute::get(fn () => $this->meta_title ?: $this->title);
    }

    /**
     * Accessor: SEO Description
     * Uses meta_description or excerpt, fallback to content snippet
     */
    protected function seoDescription(): Attribute
    {
        return Attribute::get(function () {
            $desc = $this->meta_description ?: $this->excerpt;
            if (!$desc) {
                $desc = substr(strip_tags($this->content), 0, 160);
            }
            return $desc;
        });
    }

    /**
     * Scope a query to only include published articles.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->where(function ($q) {
                        $q->whereNull('published_at')->orWhere('published_at', '<=', now());
                     });
    }
}
