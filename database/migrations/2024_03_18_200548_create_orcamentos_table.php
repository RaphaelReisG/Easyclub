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
        Schema::create('orcamentos', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('description');
            $table->string('response_observation')->nullable();
            $table->dateTime('data_inicio_analise')->nullable();
            //$table->dateTime('data_previsao')->nullable();
            $table->dateTime('data_encerramento')->nullable();
            $table->boolean('orcamento_status')->nullable();
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('administrador_id')->nullable()->constrained('administradors');
            $table->foreignId('tipo_orcamento_id')->constrained('tipo_orcamentos');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orcamentos');
    }
};
