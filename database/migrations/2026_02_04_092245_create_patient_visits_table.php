<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patient_visits', function (Blueprint $table) {
            $table->id();
            $table->string('patient_type'); // student | teacher
            $table->unsignedBigInteger('patient_id');
            $table->text('complaint');
            $table->text('intervention')->nullable();
            $table->text('treatment')->nullable();
            $table->string('administered_by');
            $table->text('remark')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_visits');
    }
};
