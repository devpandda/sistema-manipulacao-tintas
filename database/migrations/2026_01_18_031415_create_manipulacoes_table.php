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
        Schema::create('manipulacoes', function (Blueprint $table) {
            $table->id('id_manipulacao');
            $table->foreignId('id_venda')->constrained('vendas', 'id_venda')->onDelete('cascade');
            $table->foreignId('id_item_venda')->constrained('itens_vendas', 'id_item_venda')->onDelete('cascade');
            $table->foreignId('id_maquina')->constrained('maquinas', 'id_maquina');
            $table->string('id_formula')->nullable();
            $table->dateTime('data_execucao');
            $table->string('status')->default('Pendente'); // Pendente, Concluido, Erro
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manipulacoes');
    }
};
