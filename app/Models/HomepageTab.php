<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageTab extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'content',
        'image',
        'button_text',
        'button_link',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];
}
