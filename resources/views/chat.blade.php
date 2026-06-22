<x-dashboard-layout>

    <div
        class="h-[calc(100vh-12rem)] flex bg-[#111827]/40 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">

        <div class="w-full md:w-80 border-r border-gray-800 flex flex-col bg-gray-900/20">

            <div class="px-4 pt-4 bg-[#111827]/60">
                <a href="{{ route('profissionais.index') }}"
                    class="text-xs text-gray-400 hover:text-orange-500 flex items-center gap-1 transition-colors">
                    ← Voltar para Explorar
                </a>
            </div>

            <div class="p-4 border-b border-gray-800 bg-[#111827]/60">
                <h3 class="font-bold text-white text-lg">Suas Conversas</h3>
                <p class="text-xs text-gray-500 mt-1">Selecione um profissional para conversar</p>
            </div>

            <div class="flex-1 overflow-y-auto p-2 space-y-1">
                @forelse($conversas as $conversa)
                    <a href="{{ route('chat', $conversa->id) }}"
                        class="flex items-center gap-3 p-3 rounded-xl transition-all {{ isset($chatAtivo) && $chatAtivo->id == $conversa->id ? 'bg-orange-600/10 border border-orange-500/30 text-white' : 'hover:bg-gray-800/40 border border-transparent text-gray-400 hover:text-gray-200' }}">
                        <div
                            class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center font-bold text-sm text-orange-400 border border-gray-700 uppercase">
                            {{ substr($conversa->name, 0, 2) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold truncate">{{ $conversa->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ $conversa->localizacao ?? 'Sem localização' }}
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="text-center py-8 px-4">
                        <p class="text-xs text-gray-500 italic">Nenhuma conversa iniciada.</p>
                        <a href="{{ route('profissionais.index') }}"
                            class="text-xs text-orange-500 hover:underline mt-2 block font-medium">👉 Explorar
                            profissionais</a>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="flex-1 flex flex-col bg-gray-950/20">
            @if ($chatAtivo)
                <div class="p-4 border-b border-gray-800 bg-[#111827]/60 flex items-center gap-3">
                    <div
                        class="w-9 h-9 rounded-full bg-gray-800 flex items-center justify-center font-bold text-xs text-orange-500 border border-gray-700 uppercase">
                        {{ substr($chatAtivo->name, 0, 2) }}
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-white">{{ $chatAtivo->name }}</h4>
                        <p class="text-[11px] text-gray-400">📍 {{ $chatAtivo->localizacao ?? 'Não informada' }}</p>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto p-4 space-y-4" id="chat-messages">
                    @foreach ($mensagens as $msg)
                        @if ($msg->remetente_id == Auth::id())
                            <div class="flex justify-end">
                                <div
                                    class="max-w-[70%] bg-orange-600 text-white px-4 py-2.5 rounded-2xl rounded-tr-none shadow-md text-sm">
                                    <p class="leading-relaxed break-words">{{ $msg->conteudo }}</p>
                                    <span class="text-[10px] text-orange-200 block text-right mt-1 font-mono">
                                        {{ $msg->created_at->format('H:i') }}
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="flex justify-start">
                                <div
                                    class="max-w-[70%] bg-gray-900 border border-gray-800 text-gray-100 px-4 py-2.5 rounded-2xl rounded-tl-none shadow-md text-sm">
                                    <p class="leading-relaxed break-words">{{ $msg->conteudo }}</p>
                                    <span class="text-[10px] text-gray-500 block text-left mt-1 font-mono">
                                        {{ $msg->created_at->format('H:i') }}
                                    </span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="p-4 border-t border-gray-800 bg-[#111827]/40">
                    <form method="POST" action="{{ route('chat.enviar', $chatAtivo->id) }}" class="flex gap-2">
                        @csrf
                        <input type="text" name="conteudo" placeholder="Digite sua mensagem..." required
                            autocomplete="off"
                            class="flex-1 bg-gray-950 border border-gray-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-orange-500 transition-colors">
                        <button type="submit"
                            class="bg-orange-600 hover:bg-orange-500 text-white font-bold text-xs px-5 rounded-xl transition-all shadow-md shadow-orange-600/10">
                            Enviar ⚡
                        </button>
                    </form>
                </div>
            @else
                <div class="flex-1 flex flex-col items-center justify-center p-8 text-center">
                    <span class="text-4xl mb-3 block">💬</span>
                    <h4 class="text-sm font-bold text-white">Nenhuma conversa selecionada</h4>
                    <p class="text-xs text-gray-500 mt-1 max-w-xs">Escolha um contato na barra lateral ou acesse a lista
                        de profissionais para iniciar uma conversa.</p>
                </div>
            @endif
        </div>

    </div>

    <script>
        const chatBox = document.getElementById('chat-messages');
        if (chatBox) {
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    </script>

</x-dashboard-layout>
