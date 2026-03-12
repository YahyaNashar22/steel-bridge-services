<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageServiceItem extends Model
{
    protected $fillable = [
        'section',
        'title',
        'image',
        'link',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
