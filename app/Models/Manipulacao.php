<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manipulacao extends Model
{
    protected $table = 'manipulacoes';
    protected $primaryKey = 'id_manipulacao';

    protected $fillable = [
        'id_venda',
        'id_item_venda',
        'id_maquina',
        'id_formula',
        'data_execucao',
        'status',
        'observacoes',
    ];

    public function venda()
    {
        return $this->belongsTo(Venda::class, 'id_venda', 'id_venda');
    }

    public function itemVenda()
    {
        return $this->belongsTo(ItemVenda::class, 'id_item_venda', 'id_item_venda');
    }

    public function maquina()
    {
        return $this->belongsTo(Maquina::class, 'id_maquina', 'id_maquina');
    }

    public function itens()
    {
        return $this->hasMany(ItemManipulacao::class, 'id_manipulacao', 'id_manipulacao');
    }
}
