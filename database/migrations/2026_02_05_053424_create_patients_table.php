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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            // student | teacher
            $table->string('patient_type');

            // student_id or teacher_id
            $table->unsignedBigInteger('ref_id');

            // snapshot info
            $table->string('name');
            $table->integer('age')->nullable();
            $table->string('sex')->nullable();
            $table->string('grade_or_level')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
