<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ auth()->id() }}">
    <title>{{ config('app.name', 'SkillMap') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#0b1329] text-gray-100 min-h-screen antialiased font-sans">

    <nav class="bg-[#111827]/60 border-b border-gray-800/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                <a href="/" class="text-2xl font-black text-white tracking-tight">
                    Skill<span class="text-orange-500">Map</span>
                </a>

                <div class="flex items-center gap-4">
                    {{-- Se o usuário ESTIVER LOGADO, mostra o link para o painel dele --}}
                    @auth
                        <span class="text-xs text-gray-400 hidden sm:inline">Conectado como <strong
                                class="text-white">{{ Auth::user()->name }}</strong></span>
                        <a href="{{ route('dashboard') }}"
                            class="bg-orange-600 hover:bg-orange-500 text-white px-4 py-2 rounded-xl text-xs font-bold tracking-wide transition-all shadow-lg shadow-orange-600/10">
                            Meu Painel
                        </a>
                    @endauth

                    {{-- Se o usuário NÃO ESTIVER LOGADO, mostra o botão clássico --}}
                    @guest
                        <a href="{{ route('login') }}"
                            class="bg-gray-950 border border-gray-800 text-gray-300 hover:text-white px-4 py-2 rounded-xl text-xs font-bold tracking-wide transition-all hover:border-orange-500/30">
                            Área Restrita →
                        </a>
                    @endguest
                </div>

            </div>
        </div>
    </nav>

    <main class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        {{ $slot }}
    </main>
    <div id="reverb-toast"
        class="fixed bottom-5 right-5 z-50 transform translate-y-20 opacity-0 pointer-events-none transition-all duration-500 ease-out max-w-sm w-full bg-slate-900 border border-slate-800 rounded-2xl shadow-2xl p-4 flex items-start gap-3">
        <div class="bg-orange-500/10 text-orange-500 p-2 rounded-xl text-lg flex items-center justify-center">
            💬
        </div>
        <div class="flex-1">
            <h4 class="text-sm font-bold text-white">Nova mensagem!</h4>
            <p id="reverb-toast-msg" class="text-xs text-slate-400 mt-0.5 line-clamp-2">Você recebeu um novo ping no
                chat.</p>
            <a href="{{ route('chat') }}"
                class="text-[11px] font-bold text-orange-500 hover:text-orange-400 mt-2 inline-block transition-colors">
                Abrir Conversa →
            </a>
        </div>
        <button
            onclick="document.getElementById('reverb-toast').classList.add('opacity-0', 'translate-y-20', 'pointer-events-none')"
            class="text-slate-500 hover:text-slate-400 text-xs p-1">
            ✕
        </button>
    </div>
</body>

</body>

</html>
