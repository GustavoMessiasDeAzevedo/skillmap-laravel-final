<?php

namespace App\Events;

use App\Models\Mensagem; // Ou o nome do seu model de mensagens (ex: Mensagem)
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MensagemEnviada implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $mensagem;

    public function __construct($mensagem)
    {
        $this->mensagem = $mensagem;
    }

    public function broadcastOn(): array
    {
        return [
            new \Illuminate\Broadcasting\Channel('notificacoes.' . $this->mensagem->destinatario_id),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->mensagem->id,
            'sender_id' => $this->mensagem->remetente_id,
            'receiver_id' => $this->mensagem->destinatario_id,
            'content' => $this->mensagem->conteudo,
        ];
    }

    public function broadcastAs(): string
    {
        return 'mensagem.enviada';
    }
}
