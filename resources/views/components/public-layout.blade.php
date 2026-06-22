<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

</body>

</html>
