<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $primaryKey = 'id_produto';

    protected $fillable = [
        'nome',
        'imagem',
        'descricao',
        'marca',
        'sku',
        'codigo_barra',
        'categoria',
        'classificacao_tinta',
        'unidade_padrao',
        'volume',
        'custo',
        'valor_venda',
        'serializado',
        'ativo',
    ];

    public function estoque()
    {
        return $this->hasMany(Estoque::class, 'id_produto', 'id_produto');
    }
}
