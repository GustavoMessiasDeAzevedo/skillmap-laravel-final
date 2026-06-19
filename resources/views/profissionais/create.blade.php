<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SkillMap - Cadastrar Profissional</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-slate-950 min-h-screen flex items-center justify-center p-4 overflow-x-hidden relative">

    <div
        class="absolute top-1/4 left-1/4 w-96 h-96 bg-indigo-600/10 rounded-full blur-[120px] pointer-events-none animate-[pulse_8s_ease-in-out_infinite]">
    </div>
    <div
        class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-orange-500/10 rounded-full blur-[100px] pointer-events-none animate-[pulse_10s_ease-in-out_infinite_reverse]">
    </div>
    <div
        class="max-w-xl w-full bg-slate-900/40 backdrop-blur-xl p-8 rounded-2xl border border-slate-800/80 shadow-2xl shadow-black/80 relative z-10 my-8">

        <h1 class="text-3xl font-extrabold text-white mb-6">
            Cadastre-<span class="text-orange-500 drop-shadow-[0_2px_8px_rgba(249,115,22,0.4)]">se</span>
        </h1>

        {{-- Alertas de Erro Reestilizados para o Modo Dark --}}
        @if ($errors->any())
            <div
                class="bg-red-950/40 border border-red-800/60 text-red-400 p-4 rounded-xl mb-6 text-sm backdrop-blur-sm">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profissionais.store') }}" method="post" class="space-y-5">
            @csrf

            <div>
                <label class="block text-slate-300 font-medium text-sm mb-1.5">Nome Completo</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full bg-slate-950/60 border border-slate-800 rounded-xl p-3 text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all">
            </div>

            <div>
                <label class="block text-slate-300 font-medium text-sm mb-1.5">E-mail Corporativo</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full bg-slate-950/60 border border-slate-800 rounded-xl p-3 text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all">
            </div>

            <div>
                <label class="block text-slate-300 font-medium text-sm mb-1.5">Senha de Acesso</label>
                <input type="password" name="password" id="password"
                    class="w-full bg-slate-950/60 border border-slate-800 rounded-xl p-3 text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all">
            </div>

            <div>
                <label class="block text-slate-300 font-medium text-sm mb-1.5">Localização (Cidade - UF)</label>
                <input type="text" name="localizacao" id="localizacao" value="{{ old('localizacao') }}"
                    placeholder="Ex: Marília - SP"
                    class="w-full bg-slate-950/60 border border-slate-800 rounded-xl p-3 text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all">
            </div>

            <div>
                <label class="block text-slate-300 font-medium text-sm mb-1.5">Habilidades / Competências</label>
                <input type="text" name="habilidades" id="habilidades" value="{{ old('habilidades') }}"
                    class="w-full bg-slate-950/60 border border-slate-800 rounded-xl p-3 text-white placeholder-slate-600 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-all"
                    placeholder="Ex: PHP, Laravel, Docker, MySQL">
                <p class="text-xs text-slate-500 mt-1.5">Separe as competências utilizando vírgulas.</p>
            </div>

            <div class="pt-4 flex justify-between items-center border-t border-slate-800/60">
                <button
                    class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-indigo-500 active:scale-[0.99] transition-all shadow-lg shadow-indigo-500/20">
                    <a href="{{ route('home') }}"
                        class="text-sm text-white hover:text-white transition">
                        Voltar para Home
                    </a>
                </button>

                <button type="submit"
                    class="bg-orange-500 text-white px-6 py-3 rounded-xl font-semibold hover:bg-orange-400 active:scale-[0.99] transition-all shadow-lg shadow-orange-500/10">
                    Cadastrar Perfil
                </button>
            </div>
        </form>
    </div>

</body>

</html>
