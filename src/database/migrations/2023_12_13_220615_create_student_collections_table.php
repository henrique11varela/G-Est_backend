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
        Schema::create('student_collections', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            //IS START_DATE NECESSARY? ASK CARLA
            $table->timestamp('start_date');

            $table->foreignId('course_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_collections');
    }
};