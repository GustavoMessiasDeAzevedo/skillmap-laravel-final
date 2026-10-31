<?php

namespace App\Events;

use App\Models\Mensagem;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MensagemEnviada implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $mensagem;

    public function __construct(Mensagem $mensagem)
    {
        $this->mensagem = $mensagem;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('notificacoes.'.$this->mensagem->destinatario_id),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->mensagem->id,
            'remetente_id' => $this->mensagem->remetente_id,
            'destinatario_id' => $this->mensagem->destinatario_id,
            'content' => $this->mensagem->conteudo,
            'created_at' => $this->mensagem->created_at->toIso8601String(),
        ];
    }

    public function broadcastAs(): string
    {
        return 'mensagem.enviada';
    }
}
