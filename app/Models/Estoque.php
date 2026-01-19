<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $primaryKey = 'id_estoque';

    protected $fillable = [
        'id_produto',
        'lote',
        'validade',
        'quantidadeatual',
        'unidade',
        'data_entrada',
        'origem',
        'ativo',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'id_produto', 'id_produto');
    }
}
