<?php

use App\Models\ServiceSchedule;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('service_schedule_items', function (Blueprint $table) {
            $table->id();
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('enabled')->default(true);
            $table->text('reason')->nullable();
            $table->foreignIdFor(ServiceSchedule::class)->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['start_time', 'end_time', 'service_schedule_id'], 'ssi_time_schedule_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_schedule_items');
    }
};
