<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageView extends Model
{
    protected $fillable = [
    'article_id',
    'business_id',
    'type',
    'url',
    'ip_address',
    'user_agent',
    'device',
    'browser',
    'os',
    'referrer',
    'created_at'
];

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
