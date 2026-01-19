<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemManipulacao extends Model
{
    protected $table = 'itens_manipulacoes';
    protected $primaryKey = 'id_item_manipulacao';

    protected $fillable = [
        'id_manipulacao',
        'id_produto',
        'id_estoque',
        'quantidade_usada',
    ];

    public function manipulacao()
    {
        return $this->belongsTo(Manipulacao::class, 'id_manipulacao', 'id_manipulacao');
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'id_produto', 'id_produto');
    }

    public function estoque()
    {
        return $this->belongsTo(Estoque::class, 'id_estoque', 'id_estoque');
    }
}
