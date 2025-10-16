<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'images' => 'array',
        ];
    }

    public function serviceDurations(): HasMany
    {
        return $this->hasMany(ServiceDuration::class);
    }
}
