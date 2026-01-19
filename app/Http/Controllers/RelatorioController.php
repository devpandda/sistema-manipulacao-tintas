<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function vendasPorCliente(Request $request)
    {
        $search = $request->input('search');
        $vendas = collect();

        if ($search) {
            $vendas = Venda::with(['cliente', 'itens', 'itens.produto', 'itens.manipulacao'])
                ->whereHas('cliente', function ($query) use ($search) {
                    $query->where('nome', 'like', "%{$search}%");
                })
                ->orderBy('data_venda', 'desc')
                ->get();
        }

        return view('content.relatorios.vendas_por_cliente', compact('vendas', 'search'));
    }
}
