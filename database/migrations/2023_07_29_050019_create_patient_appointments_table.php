<?php

use App\Models\AttentionSchedule;
use App\Models\Patient;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patient_appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AttentionSchedule::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Patient::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('attended')->nullable();
            $table->boolean('annulled')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_appointments');
    }
};
