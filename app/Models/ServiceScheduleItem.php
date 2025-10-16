<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceScheduleItem extends Model
{
    use HasFactory;

    protected $appends = ['disabled'];

    public function serviceSchedule(): BelongsTo
    {
        return $this->belongsTo(ServiceSchedule::class);
    }

    public function bookingItems(): HasMany
    {
        return $this->hasMany(BookingItem::class);
    }

    public function getDisabledAttribute(): bool
    {
        return !$this->enabled
            || $this->bookingItems->isNotEmpty()
            || Carbon::parse("{$this->serviceSchedule->date->format('Y-m-d')} $this->start_time")->isPast();
    }
}
