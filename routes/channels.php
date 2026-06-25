<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('notificacoes.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
