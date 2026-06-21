<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfissionalController extends Controller
{
    // 1. Mostra a página de onboarding (as habilidades) logo após o cadastro
    public function onboarding()
    {
        return view('onboarding');
    }

    // 2. Recebe a string de habilidades, trata e salva no banco
    public function salvarHabilidades(Request $request)
    {
        $request->validate([
            'localizacao' => 'required|string|max:100',
            'skills' => 'required|string',
        ], [
            'localizacao.required' => 'O campo localização é obrigatório.',
            'skills.required' => 'Por favor, digite pelo menos uma habilidade.',
        ]);

        $usuario = Auth::user();
        // Aqui vai entrar a lógica de pegar a string, quebrar por vírgula e salvar.
        // Vamos fazer isso no próximo passo para não fritar mais!

        return redirect()->route('dashboard')->with('sucesso', 'Perfil configurado!');
    }
}
