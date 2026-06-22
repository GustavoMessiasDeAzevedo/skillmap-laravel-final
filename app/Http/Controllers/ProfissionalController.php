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
    public function salvarOnboarding(Request $request)
    {
        $request->validate([
            'localizacao' => 'required|string|max:100',
            'habilidades' => 'required|string',
        ], [
            'localizacao.required' => 'O campo localização é obrigatório.',
            'habilidades.required' => 'Por favor, digite pelo menos uma habilidade.',
        ]);

        $usuario = Auth::user();


        $habilidadesTratadas = array_map('trim', explode(',', $request->habilidades));

        $usuario->habilidades = implode(',', $habilidadesTratadas);
        $usuario->localizacao = $request->localizacao;
        $usuario->save();

        return redirect()->route('dashboard')->with('sucesso', 'Perfil configurado!');
    }
}
