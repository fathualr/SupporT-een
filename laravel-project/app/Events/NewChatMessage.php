<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewChatMessage implements ShouldBroadcast
{
    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new Channel('chat.' . $this->message->id_konsultasi);
    }

    public function broadcastAs()
    {
        return 'message.sent';
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->message->id,
            'pesan' => $this->message->pesan,
            'pengirim' => $this->message->pengirim,
            'created_at' => $this->message->created_at,
            'pasienFotoProfil' => $this->message->konsultasi->pasien->user->foto_profil 
                ? asset('storage/' . $this->message->konsultasi->pasien->user->foto_profil)
                : asset('images/dummy.png'),
            'tenagaAhliFotoProfil' => $this->message->konsultasi->tenagaAhli->user->foto_profil
                ? asset('storage/' . $this->message->konsultasi->tenagaAhli->user->foto_profil)
                : asset('images/dummy.png'),
        ];
    }
}
