<?php

use App\Models\Booking;
use App\Models\Service;
use App\Models\ServiceDuration;
use App\Models\ServiceScheduleItem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('booking_items', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->text('booking_entity');
            $table->foreignIdFor(Service::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(ServiceDuration::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(ServiceScheduleItem::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Booking::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_items');
    }
};
