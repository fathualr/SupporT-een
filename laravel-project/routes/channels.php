<?php

use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });
Broadcast::channel('chat.{id_konsultasi}', function ($user, $id_konsultasi) {
    $konsultasi = \App\Models\Konsultasi::find($id_konsultasi);
    
    return ($user->id === $konsultasi->pasien->user_id) || 
        ($user->id === $konsultasi->tenagaAhli->user_id);
});