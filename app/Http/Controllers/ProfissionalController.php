<?php

namespace App\Http\Controllers;

use App\Models\Habilidade;
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

        $usuario->localizacao = $request->localizacao;
        $usuario->save();

        $nomesHabilidades = array_map('trim', explode(',', $request->habilidades));
        $habilidadesIds = [];

        foreach ($nomesHabilidades as $nome) {
            if (!empty($nome)) {
                $habilidade = Habilidade::firstOrCreate(['nome' => $nome]);
                $habilidadesIds[] = $habilidade->id;
            }
        }

        $usuario->habilidades()->sync($habilidadesIds);

        return redirect()->route('dashboard')->with('sucesso', 'Perfil configurado!');
    }


    public function index(Request $request)
    {

        $localizacoesRaw = User::whereNotNull('localizacao')
            ->where('localizacao', '!=', '')
            ->pluck('localizacao');

        $cidadesNormalizadas = [];
        $cidadesDisponiveis = [];

        foreach ($localizacoesRaw as $localizacao) {
            $cidadeOriginal = ucwords(preg_replace('/\s*-\s*/', '-', strtolower(trim($localizacao))));

            $cidadeChave = strtolower($cidadeOriginal);
            $cidadeChave = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $cidadeChave);
            $cidadeChave = preg_replace('/[^a-z0-9\-]/', '', $cidadeChave);

            if (!in_array($cidadeChave, $cidadesNormalizadas)) {
                $cidadesNormalizadas[] = $cidadeChave;
                $cidadesDisponiveis[] = $cidadeOriginal;
            }
        }

        $cidadesDisponiveis = collect($cidadesDisponiveis)->values();

        $query = User::where('id', '!=', Auth::id())
            ->whereNotNull('localizacao')
            ->where('localizacao', '!=', '');

        if ($request->filled('cidade')) {
            $cidadeFiltro = strtolower(trim($request->cidade));
            $cidadeFiltro = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $cidadeFiltro);
            $cidadeFiltro = preg_replace('/[^a-z0-9]/', '', $cidadeFiltro);

            $query->whereRaw("REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(LOWER(TRIM(localizacao)), 'á', 'a'), 'í', 'i'), 'ó', 'o'), 'ú', 'u'), ' ', '') LIKE ?", ["%{$cidadeFiltro}%"]);
        }

        if ($request->filled('busca')) {
            $termo = $request->busca;
            $query->where(function ($q) use ($termo) {
                $q->where('name', 'like', "%{$termo}%")
                    ->orWhereHas('habilidades', function ($subQuery) use ($termo) {
                        $subQuery->where('nome', 'like', "%{$termo}%");
                    });
            });
        }

        $profissionais = $query->with('habilidades')->get();

        return view('explorar', compact('profissionais', 'cidadesDisponiveis'));
    }
}
