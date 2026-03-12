<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'service_category_id',
        'title',
        'slug',
        'short_description',
        'long_description',
        'featured_image',
        'meta_title',
        'meta_description',
        'og_image',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ServiceImage::class);
    }

    public function videos(): HasMany
    {
        return $this->hasMany(ServiceVideo::class);
    }

    public function requests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class);
    }
}
