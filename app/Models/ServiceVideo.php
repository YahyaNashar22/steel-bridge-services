<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class ServiceVideo extends Model
{
    protected $fillable = [
        'service_id',
        'youtube_url',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
