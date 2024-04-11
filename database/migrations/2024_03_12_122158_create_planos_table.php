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
        Schema::create('planos', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('description');

            $table->timestamps();
        });

        Schema::create('plano_produto', function (Blueprint $table) {
            $table->id();

            $table->foreignId('plano_id')->constrained('planos');
            $table->foreignId('produto_id')->constrained('produtos');

            $table->integer('qty_item');
            $table->decimal('price_item', 10 ,2);

            $table->timestamps();
        });

        Schema::create('empresa_plano', function (Blueprint $table) {
            $table->id();

            $table->foreignId('plano_id')->constrained('planos');
            $table->foreignId('empresa_id')->constrained('empresas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planos');
        Schema::dropIfExists('plano_produto');
        Schema::dropIfExists('plano_cliente');
    }
};
