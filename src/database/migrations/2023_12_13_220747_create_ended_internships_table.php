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
        Schema::create('ended_internships', function (Blueprint $table) {
            $table->foreignId('internship_id')->constrained();
            $table->primary('internship_id');
            $table->foreignId('end_state_id')->constrained();
            $table->timestamp('end_date');
            $table->boolean('is_working_there');
            $table->enum('reason', ['Completo', 'Desistência', 'Expulsão', 'Troca']);
            $table->timestamps();
            $table->softDeletes();
            //*****OTHERSTUFF*****
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ended_internships');
    }
};
