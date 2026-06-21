<x-guest-layout>
    <h1 class="text-3xl font-extrabold text-white tracking-tight mb-2">
        Criar <span class="text-orange-500 drop-shadow-[0_2px_8px_rgba(249,115,22,0.4)]">Conta</span>
    </h1>
    <p class="text-slate-400 text-xs mb-6">Cadastre-se para começar no SkillMap.</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-slate-300 font-medium text-xs mb-1.5">Nome Completo</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                autocomplete="name"
                class="w-full bg-slate-950/60 border border-slate-800 rounded-xl p-3 text-white placeholder-slate-600 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-all text-sm">
            <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-red-400" />
        </div>

        <div>
            <label for="email" class="block text-slate-300 font-medium text-xs mb-1.5">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                autocomplete="username"
                class="w-full bg-slate-950/60 border border-slate-800 rounded-xl p-3 text-white placeholder-slate-600 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-all text-sm">
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-400" />
        </div>

        <div>
            <label for="password" class="block text-slate-300 font-medium text-xs mb-1.5">Senha</label>
            <input type="password" name="password" id="password" required autocomplete="new-password"
                class="w-full bg-slate-950/60 border border-slate-800 rounded-xl p-3 text-white placeholder-slate-600 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-all text-sm">
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-400" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-slate-300 font-medium text-xs mb-1.5">Confirmar
                Senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required
                autocomplete="new-password"
                class="w-full bg-slate-950/60 border border-slate-800 rounded-xl p-3 text-white placeholder-slate-600 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-all text-sm">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-red-400" />
        </div>

        <button type="submit"
            class="w-full bg-orange-500 text-white font-semibold py-3.5 rounded-xl hover:bg-orange-400 active:scale-[0.99] transition-all shadow-lg shadow-orange-500/30 text-center text-sm mt-2 cursor-pointer">
            Finalizar Cadastro
        </button>
    </form>

    <div class="mt-6 pt-4 border-t border-slate-800/40 flex justify-between items-center text-xs">
        <a href="{{ route('home') }}" class="text-slate-500 hover:text-white transition hover:underline">← Voltar</a>
        <a href="{{ route('login') }}"
            class="text-indigo-400 hover:text-indigo-300 transition hover:underline font-medium">Já tem conta? Entre
            aqui</a>
    </div>
</x-guest-layout>
