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
        Schema::create('started_internships', function (Blueprint $table) {
            $table->foreignId('internship_id')->constrained();
            $table->primary('internship_id');
            $table->boolean('meal_allowance');
            $table->timestamp('start_date');
            $table->foreignId('company_address_id')->constrained();
            $table->foreignId('company_person_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('started_internships');
    }
};
