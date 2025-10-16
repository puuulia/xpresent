<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceSchedule extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    public function serviceDuration(): BelongsTo
    {
        return $this->belongsTo(ServiceDuration::class);
    }

    public function serviceScheduleItems(): HasMany
    {
        return $this->hasMany(ServiceScheduleItem::class);
    }
}
