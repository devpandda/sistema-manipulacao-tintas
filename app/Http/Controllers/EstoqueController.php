<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Produto;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    /**
     * Store a newly created stock batch in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_produto' => 'required|exists:produtos,id_produto',
            'lote' => 'nullable|string|max:100',
            'validade' => 'nullable|date',
            'quantidadeatual' => 'required|numeric|min:0',
            'unidade' => 'nullable|string|max:10',
            'origem' => 'nullable|string|max:255',
        ]);

        $validatedData['ativo'] = true;
        
        Estoque::create($validatedData);

        return redirect()->back()->with('success', 'Lote de estoque adicionado com sucesso!');
    }

    /**
     * Remove the specified stock batch from storage.
     */
    public function destroy($id)
    {
        $estoque = Estoque::findOrFail($id);
        $estoque->delete();

        return redirect()->back()->with('success', 'Lote de estoque removido com sucesso!');
    }
}
