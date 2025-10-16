<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceDuration extends Model
{
    use HasFactory;

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function serviceSchedules(): HasMany
    {
        return $this->hasMany(ServiceSchedule::class);
    }

    public function futureServiceSchedules(): HasMany
    {
        return $this->serviceSchedules()->whereDate('date', '>=', today());
    }
}
