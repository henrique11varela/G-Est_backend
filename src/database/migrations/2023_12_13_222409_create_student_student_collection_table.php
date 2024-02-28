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
        Schema::create('student_student_collection', function (Blueprint $table) {
            $table->foreignId('student_id')->constrained();
            $table->foreignId('student_collection_id')->constrained();
            $table->primary(['student_id', 'student_collection_id']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_student_collection');
    }
};
