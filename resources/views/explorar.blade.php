<x-public-layout>

    <!-- 1. Header Minimalista e Amplo -->
    <header class="flex justify-between items-center border-b border-gray-800 pb-6 mb-10">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight">
                Skill<span class="text-orange-500">Map</span>
            </h1>
            <p class="text-xs text-gray-400 mt-1">Conectando desenvolvedores e projetos locais</p>
        </div>

        <a href="{{ route('login') }}"
           class="bg-gray-950 border border-gray-800 text-gray-300 hover:text-white px-4 py-2 rounded-xl text-xs font-bold tracking-wide transition-all hover:border-orange-500/30">
            Área Restrita →
        </a>
    </header>

    <!-- 2. Título Principal Grande e Visível -->
    <div class="mb-10">
        <h2 class="text-4xl md:text-5xl font-black text-white tracking-tight">
            Profissionais Disponíveis
        </h2>
        <p class="text-sm md:text-base text-gray-400 mt-3 max-w-2xl">
            Explore os talentos ativos na sua região atualizados em tempo real. Veja qualificações e localizações abaixo.
        </p>
    </div>

    <!-- 3. Grid Multicolunas Perfeito (2 colunas no tablet, 3 no monitor) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse($profissionais as $profissional)
            <div class="bg-gray-800/40 border border-gray-700/60 rounded-2xl p-6 shadow-xl flex flex-col justify-between transition-all duration-300 hover:border-orange-500/20 group">

                <div>
                    <!-- Nome do Dev -->
                    <h3 class="font-extrabold text-2xl text-white group-hover:text-orange-400 transition-colors duration-300">
                        {{ $profissional->name }}
                    </h3>

                    <!-- Localização com Alto Contraste -->
                    <p class="text-gray-200 text-xs flex items-center gap-1.5 mt-3 font-bold bg-gray-950 border border-gray-700 px-3 py-1.5 rounded-xl inline-flex">
                        <span class="text-orange-500">📍</span> {{ $profissional->localizacao }}
                    </p>
                </div>

                <!-- Divisor e Habilidades -->
                <div class="border-t border-gray-700/60 pt-4 mt-6">
                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest block mb-2.5">Habilidades</span>

                    <div class="flex flex-wrap gap-1.5">
                        @foreach(explode(',', $profissional->habilidades) as $tag)
                            @if(!empty(trim($tag)))
                                <span class="bg-gray-950 border border-gray-700 text-gray-200 text-xs px-3 py-1.5 rounded-xl font-mono font-bold tracking-wide">
                                    {{ trim($tag) }}
                                </span>
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>
        @empty
            <div class="col-span-full p-12 text-center border border-dashed border-gray-800 rounded-2xl bg-gray-800/10">
                <p class="text-gray-400 text-sm font-medium">Nenhum profissional cadastrado no momento.</p>
            </div>
        @endforelse

    </div>

</x-public-layout>
