<?php

namespace App\Models;

use App\Helpers\ContentHelper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id', 'title', 'slug', 'excerpt', 'content', 'image', 'image_2', 'image_3', 'image_4', 
        'image_alt', 'category_name', 'view_count', 'click_count', 'whatsapp_clicks', 'phone_clicks',
        'is_featured', 'is_published', 'status', 'published_at', 'meta_title', 'meta_description', 
        'canonical_url'
    ];

    /**
     * Accessor: Title with Spintax Support
     */
    protected function title(): Attribute
    {
        return Attribute::get(fn ($value) => ContentHelper::process($value, $this, false));
    }

    /**
     * Accessor: Excerpt with Spintax Support
     */
    protected function excerpt(): Attribute
    {
        return Attribute::get(fn ($value) => ContentHelper::process($value, $this, false));
    }

    /**
     * Accessor: Content with SEO Engine Support
     */
    protected function content(): Attribute
    {
        return Attribute::get(fn ($value) => ContentHelper::process($value, $this));
    }

    /**
     * Accessor: Meta Title with Spintax Support
     */
    protected function metaTitle(): Attribute
    {
        return Attribute::get(fn ($value) => ContentHelper::process($value, $this, false));
    }

    /**
     * Accessor: Meta Description with Spintax Support
     */
    protected function metaDescription(): Attribute
    {
        return Attribute::get(fn ($value) => ContentHelper::process($value, $this, false));
    }

    /**
     * Get the user that owns the article.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->where('is_approved', true)->latest();
    }

    /**
     * The short keywords that belong to the article.
     */
    public function shortKeywords()
    {
        return $this->belongsToMany(ShortKeyword::class);
    }

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
     */
    protected function seoTitle(): Attribute
    {
        return Attribute::get(fn () => $this->meta_title ?: $this->title);
    }

    /**
     * Accessor: SEO Description
     */
    protected function seoDescription(): Attribute
    {
        return Attribute::get(function () {
            $text = $this->meta_description ?: ($this->excerpt ?: $this->content);
            $clean = strip_tags($text);
            return \Illuminate\Support\Str::limit($clean, 160);
        });
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        // Internal Linking or other logic can go here if needed
    }

    /**
     * Scope a query to only include published articles.
     * WordPress style: publish, schedule (publish with future date).
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'publish')
                     ->where(function ($q) {
                        $q->whereNull('published_at')->orWhere('published_at', '<=', now());
                     });
    }

    public function scopePrivate($query)
    {
        return $query->where('status', 'private');
    }

    public function scopeDrafts($query)
    {
        return $query->where('status', 'draft');
    }
}
