<x-guest-layout>
    <h1 class="text-3xl font-extrabold text-white tracking-tight mb-2">
        Acesse <span class="text-indigo-500 drop-shadow-[0_2px_8px_rgba(99,102,241,0.4)]">Sua Conta</span>
    </h1>
    <p class="text-slate-400 text-xs mb-6">Informe seu E-mail e senha para entrar.</p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <div>
            <label for="email" class="block text-slate-300 font-medium text-xs mb-1.5">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                   class="w-full bg-slate-950/60 border border-slate-800 rounded-xl p-3 text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all text-sm">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-400" />
        </div>

        <div>
            <label for="password" class="block text-slate-300 font-medium text-xs mb-1.5">Senha</label>
            <input type="password" name="password" id="password" required
                   class="w-full bg-slate-950/60 border border-slate-800 rounded-xl p-3 text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all text-sm">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-400" />
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-3.5 rounded-xl hover:bg-indigo-500 active:scale-[0.99] transition-all shadow-lg shadow-indigo-600/30 text-center text-sm mt-2 cursor-pointer">
            Entrar no Sistema
        </button>
    </form>

    <div class="mt-6 pt-4 border-t border-slate-800/40 flex justify-between items-center text-xs">
        <a href="{{ route('home') }}" class="text-slate-500 hover:text-white transition hover:underline">← Voltar</a>
        <a href="{{ route('register') }}" class="text-orange-400 hover:text-orange-300 transition hover:underline font-medium">Não tem conta? Cadastre-se</a>
    </div>
</x-guest-layout>
