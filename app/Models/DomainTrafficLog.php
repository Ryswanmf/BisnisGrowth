<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DomainTrafficLog extends Model
{
    protected $fillable = ['domain_id', 'date', 'hits'];

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
}
