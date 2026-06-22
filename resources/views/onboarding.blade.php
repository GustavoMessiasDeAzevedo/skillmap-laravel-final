<x-guest-layout>
    <h1 class="text-3xl font-extrabold text-white tracking-tight mb-2">
        Quase <span class="text-indigo-500 drop-shadow-[0_2px_8px_rgba(99,102,241,0.4)]">Pronto!</span>
    </h1>
    <p class="text-slate-400 text-xs mb-6">Complete seu perfil para ser encontrado no mapa.</p>

    <form method="POST" action="{{ route('onboarding.salvar') }}" class="space-y-5">
        @csrf

        <div>
            <label for="habilidades" class="block text-slate-300 font-medium text-xs mb-1.5">Suas Habilidades</label>
            <input type="text" name="habilidades" id="habilidades" required autofocus
                placeholder="Ex: PHP, Laravel, Tailwind, Vue"
                class="w-full bg-slate-950/60 border border-slate-800 rounded-xl p-3 text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all text-sm">
            <p class="text-[10px] text-slate-500 mt-1.5">Separe as habilidades por vírgula.</p>
            <x-input-error :messages="$errors->get('habilidades')" class="mt-1 text-xs text-red-400" />
        </div>

        <div>
            <label for="localizacao" class="block text-slate-300 font-medium text-xs mb-1.5">Sua Cidade / Estado</label>
            <input type="text" name="localizacao" id="localizacao" required placeholder="Ex: Marília - SP"
                class="w-full bg-slate-950/60 border border-slate-800 rounded-xl p-3 text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all text-sm">
            <x-input-error :messages="$errors->get('localizacao')" class="mt-1 text-xs text-red-400" />
        </div>

        <button type="submit"
            class="w-full bg-indigo-600 text-white font-semibold py-3.5 rounded-xl hover:bg-indigo-500 active:scale-[0.99] transition-all shadow-lg shadow-indigo-600/30 text-center text-sm mt-2 cursor-pointer">
            Salvar e Entrar
        </button>
    </form>
</x-guest-layout>
