<?php

namespace App\Http\Controllers;

use App\Models\User;
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


    public function index(Request $request)
    {
        $cidadesDisponiveis = User::whereNotNull('localizacao')
            ->where('localizacao', '!=', '')
            ->select('localizacao')
            ->distinct()
            ->pluck('localizacao');

        $query = User::where('id', '!=', Auth::id())
            ->whereNotNull('localizacao')
            ->where('localizacao', '!=', '')
            ->whereNotNull('habilidades')
            ->where('habilidades', '!=', '');

        if ($request->filled('cidade')) {
            $query->where('localizacao', $request->cidade);
        }

        if ($request->filled('busca')) {
            $termo = $request->busca;
            $query->where(function ($q) use ($termo) {
                $q->where('habilidades', 'like', "%{$termo}%")
                    ->orWhere('name', 'like', "%{$termo}%");
            });
        }

        $profissionais = $query->get();

        return view('explorar', compact('profissionais', 'cidadesDisponiveis'));
    }
}
