<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['business_id', 'ip_address', 'user_agent', 'referrer', 'created_at'])]
class PageView extends Model
{
    /**
     * The name of the "updated at" column.
     *
     * @var string|null
     */
    const UPDATED_AT = null;

    /**
     * Get the business that owns the page view.
     */
    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }
}
