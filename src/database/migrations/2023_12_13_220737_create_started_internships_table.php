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
            $table->boolean('hq_shipping_address');
            $table->integer('hourly_load');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->foreignId('company_address_id')->nullable()->constrained();
            $table->foreignId('company_person_id')->nullable()->constrained();
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
