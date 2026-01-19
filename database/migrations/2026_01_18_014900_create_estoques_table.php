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
        Schema::create('estoques', function (Blueprint $table) {
            $table->id('id_estoque');
            $table->foreignId('id_produto')->constrained('produtos', 'id_produto')->onDelete('cascade');
            $table->string('lote')->nullable();
            $table->date('validade')->nullable();
            $table->decimal('quantidadeatual', 10, 2)->default(0);
            $table->string('unidade')->nullable();
            $table->dateTime('data_entrada')->useCurrent();
            $table->string('origem')->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estoques');
    }
};
