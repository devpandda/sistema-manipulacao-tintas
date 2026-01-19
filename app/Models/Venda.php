<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $primaryKey = 'id_venda';
    
    protected $fillable = [
        'id_cliente',
        'descricao',
        'data_venda',
        'valor_total',
        'status',
        'observacoes',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function itens()
    {
        return $this->hasMany(ItemVenda::class, 'id_venda', 'id_venda');
    }
}
