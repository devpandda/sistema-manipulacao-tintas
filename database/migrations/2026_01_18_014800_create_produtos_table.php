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
            $table->id('id_produto');
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->string('marca')->nullable();
            $table->string('sku')->unique()->nullable();
            $table->string('categoria')->nullable();
            $table->string('classificacao_tinta')->nullable();
            $table->string('unidade_padrao')->nullable(); // L, KG, UN
            $table->decimal('custo', 10, 2)->default(0);
            $table->decimal('valor_venda', 10, 2)->default(0);
            $table->boolean('serializado')->default(false);
            $table->boolean('ativo')->default(true);
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
