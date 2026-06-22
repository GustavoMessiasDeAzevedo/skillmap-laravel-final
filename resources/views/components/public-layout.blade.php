<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SkillMap') }} - Explorar</title>

    <!-- Fontes e Estilos do Tailwind -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-900 text-gray-100 min-h-screen antialiased font-sans">

    <!-- Largura máxima expandida (6xl) para usar as laterais -->
    <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        {{ $slot }}
    </div>

</body>

</html>
