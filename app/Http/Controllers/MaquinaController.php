<?php

namespace App\Http\Controllers;

use App\Models\Maquina;
use Illuminate\Http\Request;

class MaquinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maquinas = Maquina::all();
        return view('content.maquinas.index', compact('maquinas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.maquinas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'marca' => 'nullable|string|max:100',
            'modelo' => 'nullable|string|max:100',
            'numero_serie' => 'nullable|string|max:100|unique:maquinas,numero_serie',
            'status' => 'nullable|string|max:50',
            'capacidade' => 'nullable|string|max:50',
            'observacoes' => 'nullable|string',
            'ativo' => 'boolean',
        ]);

        $validatedData['ativo'] = $request->has('ativo');

        Maquina::create($validatedData);

        return redirect()->route('maquinas.index')->with('success', 'Máquina cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Maquina $maquina)
    {
        return view('content.maquinas.show', compact('maquina'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maquina $maquina)
    {
        return view('content.maquinas.edit', compact('maquina'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maquina $maquina)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'marca' => 'nullable|string|max:100',
            'modelo' => 'nullable|string|max:100',
            'numero_serie' => 'nullable|string|max:100|unique:maquinas,numero_serie,' . $maquina->id_maquina . ',id_maquina',
            'status' => 'nullable|string|max:50',
            'capacidade' => 'nullable|string|max:50',
            'observacoes' => 'nullable|string',
            'ativo' => 'boolean',
        ]);

        $validatedData['ativo'] = $request->has('ativo');

        $maquina->update($validatedData);

        return redirect()->route('maquinas.index')->with('success', 'Máquina atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maquina $maquina)
    {
        $maquina->delete();

        return redirect()->route('maquinas.index')->with('success', 'Máquina excluída com sucesso!');
    }
}
