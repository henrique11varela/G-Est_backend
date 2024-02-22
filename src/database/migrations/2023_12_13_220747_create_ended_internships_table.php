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
            $table->enum('reason', ['Aprovado', 'Reprovado', 'Desistente'])->nullable();
            $table->enum('situacao_prof', ['Empregado/a', 'Desempregado/a', 'Em formação (Ensino Superior ou outra)', 'Aguardar ingresso no Ensino Superior ou outra formação', 'Em processo de contratação', 'Aguardar Estágio Profissional', 'Outra', 'S/ Informação', 'Em formação - CET ATEC'])->nullable();
            $table->enum('como_obteve_emprego', ['Integração na empresa de FPCT', 'Através da ATEC', 'Criou o próprio emprego', 'Resposta a anúncio', 'Conhecimentos pessoais', 'Outra', 'Trabalhava na empresa durante a FPCT'])->nullable();
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
