<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillMap - Bem-vindo</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-950 h-screen flex items-center justify-center p-4 overflow-hidden relative">

    <div class="absolute top-1/4 left-1/3 w-96 h-96 bg-indigo-600/20 rounded-full blur-[120px] pointer-events-none
                animate-[pulse_6s_ease-in-out_infinite] motion-safe:translate-y-4"></div>

    <div class="absolute bottom-1/4 right-1/3 w-80 h-80 bg-orange-500/15 rounded-full blur-[100px] pointer-events-none
                animate-[pulse_8s_ease-in-out_infinite_reverse]"></div>
    <div class="text-center max-w-md w-full p-8 bg-slate-900/40 backdrop-blur-xl border border-slate-800/80 rounded-2xl shadow-2xl shadow-black/80 relative z-10">

        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-orange-500/10 text-4xl mb-4 text-orange-500 shadow-lg shadow-orange-500/20 animate-pulse">
            🗺️
        </div>

        <h1 class="text-4xl font-extrabold text-white tracking-tight mb-3">
            Skill<span class="text-orange-500 drop-shadow-[0_2px_10px_rgba(249,115,22,0.5)]">Map</span>
        </h1>

        <p class="text-slate-400 text-sm mb-8 leading-relaxed">
            Mapeie suas competências, gerencie suas habilidades e conecte-se com as principais tecnologias do mercado de ponta.
        </p>

        <div class="flex flex-col space-y-3.5">
            <a href="{{ route('login') }}" class="w-full bg-indigo-600 text-white font-semibold py-3.5 rounded-xl hover:bg-indigo-500 active:scale-[0.99] transition-all shadow-lg shadow-indigo-600/30 text-center">
                Entrar no Sistema
            </a>

            <a href="{{ route('register') }}" class="w-full bg-orange-500 text-white font-semibold py-3.5 rounded-xl hover:bg-orange-400 active:scale-[0.99] transition-all shadow-lg shadow-orange-500/20 text-center">
                Criar Minha Conta
            </a>
        </div>

        <div class="mt-8 pt-4 border-t border-slate-800/40">
            <a href="{{ route('profissionais.index') }}" class="text-xs text-slate-500 hover:text-orange-400 hover:underline transition">
                Acessar modo visitante (Visualizar profissionais) →
            </a>
        </div>
    </div>

</body>
</html>
