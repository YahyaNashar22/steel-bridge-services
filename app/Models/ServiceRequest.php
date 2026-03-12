<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = [
        'service_id',
        'full_name',
        'phone',
        'email',
        'description',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
