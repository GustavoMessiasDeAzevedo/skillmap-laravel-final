<x-dashboard-layout>
    @if (session('sucesso'))
        <div
            class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl text-sm font-medium">
            🎉 {{ session('sucesso') }}
        </div>
    @endif
    <div class="border-b border-gray-800 pb-6 mb-10">
        <h2 class="text-4xl font-black text-white tracking-tight">
            Seu Painel
        </h2>
        <p class="text-sm text-gray-400 mt-2">
            Gerencie suas informações de localização e habilidades para destacar seu perfil na busca pública.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 bg-[#111827]/50 border border-gray-800 rounded-2xl p-6 sm:p-8 shadow-xl">
            <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                <span class="text-orange-500">⚙️</span> Atualizar Informações Profissionais
            </h3>

            <form method="POST" action="{{ route('dashboard.atualizar') }}" class="space-y-6">
                @csrf
                @method('PATCH')

                <div>
                    <label for="localizacao"
                        class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">
                        Sua Cidade / Estado
                    </label>
                    <input type="text" id="localizacao" name="localizacao"
                        value="{{ old('localizacao', Auth::user()->localizacao) }}" placeholder="Ex: Marília - SP"
                        class="w-full bg-gray-950 border border-gray-800 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-orange-500 transition-colors">
                </div>

                <div>
                    <label for="habilidades"
                        class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">
                        Habilidades (Separadas por vírgula)
                    </label>
                    <input type="text" id="habilidades" name="habilidades"
                        value="{{ auth()->user()->habilidades->pluck('nome')->implode(', ') }}"
                        placeholder="Ex: PHP, Laravel, Tailwind, MySQL"
                        class="w-full bg-gray-950 border border-gray-800 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-orange-500 transition-colors">
                    <p class="text-[11px] text-gray-500 mt-2 font-mono">As tags serão geradas automaticamente separando
                        os termos por vírgulas.</p>
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit"
                        class="bg-orange-600 hover:bg-orange-500 text-white font-bold text-sm px-6 py-3 rounded-xl shadow-lg shadow-orange-600/10 transition-all">
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>

        <div
            class="bg-[#111827]/30 border border-gray-800/80 border-dashed rounded-2xl p-6 flex flex-col justify-between">
            <div>
                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest block mb-4">Visualização do
                    seu Card Público</span>

                <h4 class="font-extrabold text-2xl text-white">
                    {{ Auth::user()->name }}
                </h4>

                <p
                    class="text-gray-300 text-xs flex items-center gap-1.5 mt-3 font-semibold bg-gray-950 border border-gray-800 px-2.5 py-1.5 rounded-xl inline-flex">
                    <span class="text-orange-500">📍</span>
                    {{ Auth::user()->localizacao ?? 'Localização não informada' }}
                </p>

                <div class="border-t border-gray-800/80 pt-4 mt-6">
                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest block mb-2.5">Habilidades
                        Ativas</span>

                    <div class="flex flex-wrap gap-1.5">
                        @if (Auth::user()->habilidades)
                            @foreach (auth()->user()->habilidades as $tag)
                                <span
                                    class="bg-gray-950 border border-gray-800 text-gray-300 text-[11px] px-2.5 py-1 rounded-lg font-mono font-medium">
                                    {{ $tag->nome }}
                                </span>
                            @endforeach
                        @else
                            <span class="text-xs text-gray-500 italic">Nenhuma tag configurada.</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-4 border-t border-gray-800/40">
                <a href="{{ route('profissionais.index') }}"
                    class="text-xs font-bold text-orange-400 hover:text-orange-300 transition-colors flex items-center gap-1">
                    ← Ver todos os profissionais ativos
                </a>
            </div>
        </div>

    </div>

</x-dashboard-layout>