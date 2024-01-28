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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('activity_sector');
            $table->string('locality');
            $table->string('website');
            $table->string('contact_name');
            $table->string('contact_telephone');
            $table->string('contact_email');
            $table->integer('number_students');
            $table->string('student_profile');
            $table->string('student_tasks');
            $table->foreignId('company_id')->constrained();
            $table->boolean('is_partner');
            //$table->boolean('is_valid')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
