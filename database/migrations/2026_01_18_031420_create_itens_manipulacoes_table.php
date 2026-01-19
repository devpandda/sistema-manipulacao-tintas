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
        Schema::create('itens_manipulacoes', function (Blueprint $table) {
            $table->id('id_item_manipulacao');
            $table->foreignId('id_manipulacao')->constrained('manipulacoes', 'id_manipulacao')->onDelete('cascade');
            $table->foreignId('id_produto')->constrained('produtos', 'id_produto'); // The colorant/ingredient
            $table->foreignId('id_estoque')->nullable()->constrained('estoques', 'id_estoque'); // Specific batch used
            $table->decimal('quantidade_usada', 10, 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itens_manipulacoes');
    }
};
