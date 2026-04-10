<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['business_id', 'title', 'url', 'icon', 'order', 'is_active', 'click_count'])]
class Link extends Model
{
    /**
     * Get the business that owns the link.
     */
    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }
}
