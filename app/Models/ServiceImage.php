<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class ServiceImage extends Model
{
    protected $fillable = [
        'service_id',
        'path',
        'alt',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
