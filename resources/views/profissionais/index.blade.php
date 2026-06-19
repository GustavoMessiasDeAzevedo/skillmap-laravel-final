<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillMap - Banco de Talentos</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100 p-8">

    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">🔍 Banco de Talentos (SkillMap)</h1>

        <div class="space-y-4">
            {{-- O @foreach do Blade passa por cada registro que o Controller enviou --}}
            @foreach ($profissionais as $pessoa)
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold text-gray-700">{{ $pessoa->name }}</h2>
                    <p class="text-gray-500 mb-3">📍 {{ $pessoa->localizacao ?? 'Não informada' }}</p>

                    <div class="flex flex-wrap gap-2">
                        {{-- O @forelse faz o loop e já trata se a pessoa não tiver competências --}}
                        @forelse ($pessoa->habilidades as $hab)
                            <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
                                {{ $hab->nome }}
                            </span>
                        @empty
                            <span class="text-gray-400 text-sm italic">Nenhuma competência cadastrada ainda.</span>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>

</html>
