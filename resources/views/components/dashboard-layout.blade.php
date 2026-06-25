<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ auth()->id() }}">
    <title>{{ config('app.name', 'SkillMap') }} - Dashboard</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#0b1329] text-gray-100 min-h-screen antialiased font-sans">

    <div class="min-h-screen flex flex-col">

        <nav class="bg-[#111827]/80 border-b border-gray-800 backdrop-blur-md sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">

                    <div class="flex items-center">
                        <a href="{{ route('dashboard') }}" class="text-2xl font-black text-white tracking-tight">
                            Skill<span class="text-orange-500">Map</span>
                        </a>
                    </div>

                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-300 font-medium hidden sm:inline">
                            Olá, {{ Auth::user()->name }}
                        </span>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="bg-gray-900 border border-gray-800 hover:border-red-500/30 text-gray-400 hover:text-red-400 px-3.5 py-2 rounded-xl text-xs font-bold tracking-wide transition-all">
                                Sair
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </nav>

        <main class="flex-1 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            {{ $slot }}
        </main>

    </div>
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

</html>
