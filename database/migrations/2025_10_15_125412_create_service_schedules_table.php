<?php

use App\Models\ServiceDuration;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('service_schedules', function (Blueprint $table) {
            $table->id();
            $table->date('date')->index();
            $table->foreignIdFor(ServiceDuration::class)->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['date', 'service_duration_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_schedules');
    }
};
