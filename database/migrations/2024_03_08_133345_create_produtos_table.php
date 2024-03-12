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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('description');
            $table->decimal('cost_price', 6, 2);
            $table->decimal('sale_price', 6, 2);
            $table->foreignId('tipo_produto_id')->constrained('tipo__produtos');
            $table->foreignId('fornecedor_id')->constrained('fornecedors');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
