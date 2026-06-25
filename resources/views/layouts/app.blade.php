<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ auth()->id() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
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
