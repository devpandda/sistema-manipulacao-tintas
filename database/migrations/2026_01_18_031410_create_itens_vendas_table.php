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
        Schema::create('itens_vendas', function (Blueprint $table) {
            $table->id('id_item_venda');
            $table->foreignId('id_venda')->constrained('vendas', 'id_venda')->onDelete('cascade');
            $table->foreignId('id_produto')->constrained('produtos', 'id_produto')->onDelete('cascade');
            $table->string('id_formula')->nullable(); // Code/Name of formula
            $table->decimal('quantidade', 10, 2);
            $table->decimal('valor_unitario', 10, 2);
            $table->decimal('valor_total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itens_vendas');
    }
};
