<?php

namespace App\Broadcasting;

use stdClass;

class RoomChannel
{
    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
    }

    public function join($user, $roomId): array|bool
    {
        if (filled($user) && filled($roomId)) {
            return $user->getData();
        }

        return false;
    }
}
