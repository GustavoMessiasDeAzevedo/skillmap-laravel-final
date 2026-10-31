<?php

namespace App\Http\Controllers;

use App\Events\MensagemEnviada;
use App\Models\Mensagem;
use App\Models\User;
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

    // API: Retorna a lista de conversas em JSON para o Flutter
    public function getConversationsApi(Request $request)
    {
        $usuarioLogado = $request->user()->id;

        $enviadas = Mensagem::query()
            ->where('remetente_id', $usuarioLogado)
            ->select('destinatario_id as contato_id');

        $contatosIds = Mensagem::query()
            ->where('destinatario_id', $usuarioLogado)
            ->select('remetente_id as contato_id')
            ->union($enviadas)
            ->pluck('contato_id')
            ->unique();

        $conversas = User::query()
            ->whereIn('id', $contatosIds)
            ->get()
            ->map(function ($user) use ($usuarioLogado) {
                $ultimaMsg = Mensagem::query()
                    ->where(function ($q) use ($usuarioLogado, $user) {
                        $q->where('remetente_id', $usuarioLogado)->where('destinatario_id', $user->id);
                    })
                    ->orWhere(function ($q) use ($usuarioLogado, $user) {
                        $q->where('remetente_id', $user->id)->where('destinatario_id', $usuarioLogado);
                    })
                    ->latest()
                    ->first();

                return [
                    'id' => $user->id,
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'avatar_url' => $user->avatar_url ?? null,
                    ],
                    'last_message' => $ultimaMsg ? [
                        'content' => $ultimaMsg->conteudo,
                        'created_at' => $ultimaMsg->created_at,
                    ] : null,
                ];
            });

        return response()->json($conversas);
    }

    // API: Retorna as mensagens de um chat em JSON para o Flutter
    public function getMessagesApi(Request $request, $id)
    {
        $usuarioLogado = $request->user()->id;

        $mensagens = Mensagem::query()
            ->where(function ($q) use ($usuarioLogado, $id) {
                $q->where('remetente_id', $usuarioLogado)->where('destinatario_id', $id);
            })
            ->orWhere(function ($q) use ($usuarioLogado, $id) {
                $q->where('remetente_id', $id)->where('destinatario_id', $usuarioLogado);
            })
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($msg) use ($usuarioLogado) {
                return [
                    'id' => $msg->id,
                    'remetente_id' => $msg->remetente_id,
                    'destinatario_id' => $msg->destinatario_id,
                    'content' => $msg->conteudo,
                    'is_me' => $msg->remetente_id === $usuarioLogado,
                    'created_at' => $msg->created_at,
                ];
            });

        return response()->json($mensagens);
    }

    // API: Envia mensagem via HTTP para o Flutter
    public function sendMessageApi(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $mensagem = Mensagem::query()->create([
            'remetente_id' => $request->user()->id,
            'destinatario_id' => $request->conversation_id,
            'conteudo' => $request->message,
            'lida' => false,
        ]);

        event(new MensagemEnviada($mensagem));

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $mensagem->id,
                'remetente_id' => $mensagem->remetente_id,
                'destinatario_id' => $mensagem->destinatario_id,
                'content' => $mensagem->conteudo,
                'is_me' => true,
            ],
        ], 201);
    }
}
