<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingItem extends Model
{
    protected $fillable = [
        'booking_id',
        'date',
        'start_time',
        'end_time',
        'service_id',
        'service_duration_id',
        'service_schedule_item_id',
        'booking_entity',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function serviceDuration(): BelongsTo
    {
        return $this->belongsTo(ServiceDuration::class);
    }

    public function serviceScheduleItem(): BelongsTo
    {
        return $this->belongsTo(ServiceScheduleItem::class);
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }
}
