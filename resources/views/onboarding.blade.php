<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillMap - Configurar Perfil</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-slate-950 h-screen flex items-center justify-center p-4 overflow-hidden relative">

    <div
        class="absolute top-1/4 left-1/4 w-96 h-96 bg-indigo-600/10 rounded-full blur-[120px] pointer-events-none animate-[pulse_8s_ease-in-out_infinite]">
    </div>
    <div
        class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-orange-500/10 rounded-full blur-[100px] pointer-events-none animate-[pulse_10s_ease-in-out_infinite_reverse]">
    </div>

    <div
        class="text-left max-w-md w-full p-8 bg-slate-900/40 backdrop-blur-xl border border-slate-800/80 rounded-2xl shadow-2xl shadow-black/80 relative z-10">

        <h1 class="text-2xl font-extrabold text-white tracking-tight mb-2">
            Seja bem-vindo ao <span class="text-indigo-500">SkillMap</span>!
        </h1>
        <p class="text-slate-400 text-xs mb-6">Sua conta foi criada. Agora, vamos configurar as suas competências.</p>

        @if ($errors->any())
            <div
                class="bg-red-950/40 border border-red-800/60 text-red-400 p-3.5 rounded-xl mb-5 text-xs backdrop-blur-sm">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('onboarding.salvar') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="localizacao" class="block text-slate-300 font-medium text-sm mb-1.5">Sua Localização</label>
                <input type="text" name="localizacao" id="localizacao" value="{{ old('localizacao') }}"
                    class="w-full bg-slate-950/60 border border-slate-800 rounded-xl p-3 text-white placeholder-slate-600 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-all text-sm"
                    placeholder="Ex: São Paulo - SP" required>
            </div>

            <div>
                <label class="block text-slate-300 font-medium text-sm mb-1.5">Habilidades / Competências</label>
                <input type="text" name="habilidades" id="habilidades" value="{{ old('habilidades') }}"
                    class="w-full bg-slate-950/60 border border-slate-800 rounded-xl p-3 text-white placeholder-slate-600 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-all text-sm"
                    placeholder="Ex: PHP, Laravel, Docker, MySQL" required>
                <p class="text-xs text-slate-500 mt-1.5">Separe as competências utilizando vírgulas.</p>
            </div>

            <button type="submit"
                class="w-full bg-orange-500 text-white font-semibold py-3.5 rounded-xl hover:bg-orange-400 active:scale-[0.99] transition-all shadow-lg shadow-orange-500/30 text-center text-sm mt-4 cursor-pointer">
                Salvar e Concluir
            </button>
        </form>
    </div>

</body>

</html>
