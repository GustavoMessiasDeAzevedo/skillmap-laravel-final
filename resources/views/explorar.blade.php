<x-public-layout>

    <div class="mb-8">
        <h2 class="text-4xl font-black text-white tracking-tight">
            Profissionais Disponíveis
        </h2>
        <p class="text-sm text-gray-400 mt-2">
            Encontre desenvolvedores e especialistas ativos na sua região.
        </p>
    </div>

    <form method="GET" action="{{ route('profissionais.index') }}"
        class="bg-[#111827]/40 border border-gray-800 p-4 rounded-2xl mb-10 flex flex-col md:flex-row gap-4 items-center justify-between">

        <div class="w-full md:w-1/2 relative">
            <input type="text" name="busca" value="{{ request('busca') }}"
                placeholder="Buscar por habilidade ou nome..."
                class="w-full bg-gray-950 border border-gray-800 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-orange-500 transition-colors">
        </div>

        <div class="flex flex-col sm:flex-row gap-2 w-full md:w-auto justify-end">

            <select name="cidade"
                class="bg-gray-950 border border-gray-800 rounded-xl px-4 py-2.5 text-xs text-gray-300 focus:outline-none focus:border-orange-500 min-w-[180px]">
                <option value="">Todas as Cidades</option>
                @foreach ($cidadesDisponiveis as $cidade)
                    <option value="{{ $cidade }}" {{ request('cidade') == $cidade ? 'selected' : '' }}>
                        {{ $cidade }}
                    </option>
                @endforeach
            </select>

            <button type="submit"
                class="bg-orange-600 hover:bg-orange-500 text-white font-bold text-xs px-5 py-2.5 rounded-xl transition-all shadow-md shadow-orange-600/10">
                Filtrar
            </button>

            {{-- Se houver filtros ativos, mostra um botão para limpar --}}
            @if (request()->has('cidade') || request()->has('busca'))
                <a href="{{ route('profissionais.index') }}"
                    class="bg-gray-800 hover:bg-gray-700 text-gray-300 font-medium text-xs px-4 py-2.5 rounded-xl transition-all text-center flex items-center justify-center">
                    Limpar
                </a>
            @endif

        </div>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse($profissionais as $profissional)
            <div
                class="bg-gray-900/40 border border-gray-700/50 rounded-2xl p-6 shadow-xl flex flex-col justify-between transition-all duration-300 hover:border-orange-500/30 group">

                <div>
                    <h3
                        class="font-extrabold text-xl text-white group-hover:text-orange-400 transition-colors duration-300">
                        {{ $profissional->name }}
                    </h3>

                    <p
                        class="text-gray-300 text-[11px] flex items-center gap-1 mt-3 font-bold bg-gray-950 border border-gray-800 px-2.5 py-1.5 rounded-lg inline-flex">
                        <span class="text-orange-500">📍</span> {{ $profissional->localizacao }}
                    </p>

                    <div class="border-t border-gray-800/60 pt-4 mt-5">
                        <span
                            class="text-[9px] font-bold text-gray-500 uppercase tracking-widest block mb-2">Habilidades</span>

                        <div class="flex flex-wrap gap-1">
                            @foreach ($profissional->habilidades as $tag)
                                <span
                                    class="bg-gray-950 border border-gray-800 text-gray-300 text-[11px] px-2.5 py-1 rounded-lg font-mono font-medium">
                                    {{ $tag->nome }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-gray-800/40">
                    <a href="{{ route('chat', $profissional->id) }}"
                        class="w-full text-center block bg-gray-950 border border-gray-800 hover:border-orange-500/40 text-gray-300 hover:text-white font-bold text-xs py-2.5 rounded-xl transition-all">
                        Abrir Chat / Contato
                    </a>
                </div>

            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 italic">Nenhum profissional encontrado.</p>
            </div>
        @endforelse

    </div>

</x-public-layout>
