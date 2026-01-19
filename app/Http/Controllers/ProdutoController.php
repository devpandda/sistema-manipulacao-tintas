<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::withSum('estoque', 'quantidadeatual')->get();
        return view('content.produtos.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.produtos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'marca' => 'nullable|string|max:100',
            'sku' => 'nullable|string|max:50|unique:produtos,sku',
            'codigo_barra' => 'nullable|string|max:50|unique:produtos,codigo_barra',
            'categoria' => 'nullable|string|max:100',
            'classificacao_tinta' => 'nullable|string|max:100',
            'unidade_padrao' => 'nullable|string|max:10',
            'volume' => 'nullable|string|max:20',
            'custo' => 'nullable|numeric|min:0',
            'valor_venda' => 'nullable|numeric|min:0',
            'serializado' => 'boolean',
            'ativo' => 'boolean',
            'imagem' => 'nullable|image|max:2048',
        ]);

        $validatedData['serializado'] = $request->has('serializado');
        $validatedData['ativo'] = $request->has('ativo');

        if ($request->hasFile('imagem')) {
            $validatedData['imagem'] = $request->file('imagem')->store('produtos', 'public');
        }
        
        Produto::create($validatedData);

        return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        $produto->load('estoque');
        return view('content.produtos.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        return view('content.produtos.edit', compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'marca' => 'nullable|string|max:100',
            'sku' => 'nullable|string|max:50|unique:produtos,sku,' . $produto->id_produto . ',id_produto',
            'categoria' => 'nullable|string|max:100',
            'classificacao_tinta' => 'nullable|string|max:100',
            'unidade_padrao' => 'nullable|string|max:10',
            'custo' => 'nullable|numeric|min:0',
            'valor_venda' => 'nullable|numeric|min:0',
            'serializado' => 'boolean',
            'ativo' => 'boolean',
            'imagem' => 'nullable|image|max:2048',
        ]);

        $validatedData['serializado'] = $request->has('serializado');
        $validatedData['ativo'] = $request->has('ativo');

        if ($request->hasFile('imagem')) {
            $validatedData['imagem'] = $request->file('imagem')->store('produtos', 'public');
        }

        $produto->update($validatedData);

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso!');
    }
}
