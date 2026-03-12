<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}
