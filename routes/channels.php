<?php

use App\Broadcasting\RoomChannel;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('rooms.{roomId}', RoomChannel::class, ['guards' => ['web', 'broadcasting']]);