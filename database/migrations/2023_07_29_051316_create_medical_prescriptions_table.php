<?php

use App\Models\MedicalHistory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medical_prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MedicalHistory::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('medicine');
            $table->string('instructions');
            $table->string('observations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_prescriptions');
    }
};
