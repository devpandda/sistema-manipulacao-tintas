<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemVenda extends Model
{
    protected $table = 'itens_vendas';
    protected $primaryKey = 'id_item_venda';

    protected $fillable = [
        'id_venda',
        'id_produto',
        'id_formula',
        'quantidade',
        'valor_unitario',
        'valor_total',
    ];

    public function venda()
    {
        return $this->belongsTo(Venda::class, 'id_venda', 'id_venda');
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'id_produto', 'id_produto');
    }

    public function manipulacao()
    {
        return $this->hasOne(Manipulacao::class, 'id_item_venda', 'id_item_venda');
    }
}
