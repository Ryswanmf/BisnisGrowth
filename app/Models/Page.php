<?php

namespace App\Models;

use App\Helpers\ContentHelper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'meta_title', 'meta_description', 'is_published'
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Accessor: Title with Content Support
     */
    protected function title(): Attribute
    {
        return Attribute::get(fn ($value) => ContentHelper::process($value));
    }

    /**
     * Accessor: Content with Content Support
     */
    protected function content(): Attribute
    {
        return Attribute::get(fn ($value) => ContentHelper::process($value));
    }
}
