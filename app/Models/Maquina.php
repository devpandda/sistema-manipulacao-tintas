<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maquina extends Model
{
    protected $primaryKey = 'id_maquina';

    protected $fillable = [
        'nome',
        'marca',
        'modelo',
        'numero_serie',
        'status',
        'capacidade',
        'observacoes',
        'ativo',
    ];
}
