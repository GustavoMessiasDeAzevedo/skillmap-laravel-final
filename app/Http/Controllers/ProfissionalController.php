<?php

namespace App\Http\Controllers;

use App\Models\Habilidade;
use App\Models\User;
use Illuminate\Http\Request;

class ProfissionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profissionais = User::with('habilidades')->get();

        return view('profissionais.index', compact('profissionais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $habilidades = Habilidade::all();
        return view('profissionais.create', compact('habilidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'localizacao' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'habilidades' => 'nullable|string'
        ]);

        $profissional = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'localizacao' => $request->localizacao,
            'password' => bcrypt($request->password)
        ]);

        if ($request->filled('habilidades')) {
            $habilidadesIds = [];

            $tags = explode(',', $request->habilidades);
            foreach ($tags as $tag) {
                $nomeHabilidade = trim($tag);
                if (!empty($nomeHabilidade)) {
                    $habilidade = Habilidade::firstOrCreate(
                        ['nome' => $nomeHabilidade]
                    );
                    $habilidadesIds[] = $habilidade->id;
                }
            };

            $profissional->habilidades()->sync($habilidadesIds);
        }

        return redirect()->route('profissionais.index')->with('sucesso', 'Profissional cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $profissional = User::with('habilidades')->findOrFail($id);

        return view('profissionais.show', compact('profissional'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $profissional = User::findOrFail($id);

        return view('profissionais.edit', compact('profissional'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profissional = User::findOrFail($id);
        $profissional->delete();

        return redirect()->route('profissionais.index');
    }
}
