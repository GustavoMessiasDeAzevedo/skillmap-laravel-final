<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

</body>

</html>
