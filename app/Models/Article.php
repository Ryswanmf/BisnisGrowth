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
        'is_featured', 'is_published', 'published_at', 'meta_title', 'meta_description', 
        'focus_keyword', 'canonical_url'
    ];

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
     * Accessor: Title with Content Support
     */
    protected function title(): Attribute
    {
        return Attribute::get(fn ($value) => ContentHelper::process($value));
    }

    /**
     * Accessor: Content with Content Support (Spintax + Related)
     */
    protected function content(): Attribute
    {
        return Attribute::get(fn ($value) => ContentHelper::process($value));
    }

    /**
     * Accessor: Excerpt with Content Support
     */
    protected function excerpt(): Attribute
    {
        return Attribute::get(fn ($value) => ContentHelper::process($value));
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
        return Attribute::get(fn () => ContentHelper::process($this->meta_title ?: $this->getRawOriginal('title')));
    }

    /**
     * Accessor: SEO Description
     */
    protected function seoDescription(): Attribute
    {
        return Attribute::get(function () {
            // Ambil meta_description atau excerpt atau content
            $text = $this->meta_description ?: ($this->excerpt ?: $this->getRawOriginal('content'));
            
            // 1. Proses Spintax dulu
            $processed = ContentHelper::process($text);
            
            // 2. Bersihkan HTML tags
            $clean = strip_tags($processed);
            
            // 3. Potong sesuai limit SEO (160 karakter)
            return \Illuminate\Support\Str::limit($clean, 160);
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
