<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'user_name',
        'user_phone',
    ];

    public function serviceDuration(): BelongsTo
    {
        return $this->belongsTo(ServiceDuration::class);
    }

    public function bookingItems(): HasMany
    {
        return $this->hasMany(BookingItem::class);
    }
}
