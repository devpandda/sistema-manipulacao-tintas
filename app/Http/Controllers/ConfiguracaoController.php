<?php

namespace App\Http\Controllers;

use App\Models\Configuracao;
use Illuminate\Http\Request;

class ConfiguracaoController extends Controller
{
    public function index()
    {
        // Get or create the msg_etiqueta setting
        $msgEtiqueta = Configuracao::firstOrCreate(
            ['chave' => 'msg_etiqueta'],
            [
                'valor' => 'Obrigado pela preferência! Volte sempre.',
                'descricao' => 'Mensagem padrão para etiquetas de produtos manipulados'
            ]
        );

        return view('content.settings.index', compact('msgEtiqueta'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'msg_etiqueta' => 'required|string|max:500',
        ]);

        $config = Configuracao::where('chave', 'msg_etiqueta')->first();
        if ($config) {
            $config->update(['valor' => $request->msg_etiqueta]);
        }

        return redirect()->route('settings.index')->with('success', 'Configurações atualizadas com sucesso!');
    }
}
