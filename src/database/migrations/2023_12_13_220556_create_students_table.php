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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('atec_email')->unique();
            $table->string('personal_email');
            $table->string('phone_number');
            $table->string('address');
            $table->string('postal_code');
            $table->string('locality');
            $table->enum('soft_skills', ['Muito Fraco', 'Fraco', 'Razoável', 'Bom', 'Muito Bom'])->nullable();
            $table->enum('hard_skills', ['Muito Fraco', 'Fraco', 'Razoável', 'Bom', 'Muito Bom'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
