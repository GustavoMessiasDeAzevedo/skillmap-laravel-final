<?php

namespace App\Http\Controllers;

use App\Events\MensagemEnviada;
use App\Models\User;
use App\Models\Mensagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index($id = null)
    {
        $usuarioLogado = Auth::id();

        $enviadas = Mensagem::query()
            ->where('remetente_id', $usuarioLogado)
            ->select('destinatario_id as contato_id');

        // 1. Busca os contatos com base no histórico de mensagens
        $contatosIds = Mensagem::query()
            ->where('destinatario_id', $usuarioLogado)
            ->select('remetente_id as contato_id')
            ->union($enviadas)
            ->pluck('contato_id')
            ->unique();

        $conversas = User::query()->whereIn('id', $contatosIds)->get();

        // 2. Prepara as variáveis para a janela de chat da direita
        $chatAtivo = null;
        $mensagens = collect();

        if ($id) {
            $chatAtivo = User::query()->findOrFail($id);

            // Usando o escopo tradicional que o editor valida sem erros
            $mensagens = Mensagem::query()
                ->where(function ($q) use ($usuarioLogado, $id) {
                    $q->where('remetente_id', $usuarioLogado)
                        ->where('destinatario_id', $id);
                })
                ->orWhere(function ($q) use ($usuarioLogado, $id) {
                    $q->where('remetente_id', $id)
                        ->where('destinatario_id', $usuarioLogado);
                })
                ->orderBy('created_at', 'asc')
                ->get();
        }

        return view('chat', compact('conversas', 'chatAtivo', 'mensagens'));
    }

    public function enviar(Request $request, $id)
    {
        $request->validate([
            'conteudo' => 'required|string',
        ]);

        $mensagem = Mensagem::query()->create([
            'remetente_id' => Auth::id(),
            'destinatario_id' => $id,
            'conteudo' => $request->conteudo,
            'lida' => false,
        ]);

        event(new MensagemEnviada($mensagem));

        return redirect()->route('chat', $id);
    }
}
