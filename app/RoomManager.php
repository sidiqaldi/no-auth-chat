<?php

namespace App;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class RoomManager
{
    public Collection $rooms;

    public function __construct()
    {
        $this->rooms = Cache::get('rooms', collect());

        $this->validate();
    }

    public function validate(): void
    {
        $this->rooms = $this->rooms->reject(function (array $room) {
            return now()->gt(Carbon::parse($room['expired_at']));
        });

        Cache::forever('rooms', $this->rooms);
    }

    public function getRooms(): Collection
    {
        return $this->rooms->where('hidden', false);
    }

    public function getRoom(string $name): ?array
    {
        $room = $this->rooms->where('name', $name)->first() ?? null;

        if (empty($room)) {
            return null;
        }

        $room['expired_at'] = now()->addMinutes(5);

        return $this->createOrUpdate($room);
    }

    public function createRoom(string $name, bool $hidden): array
    {
        $room = $this->getRoom($name);

        if (filled($room)) {
            return $room;
        }

        $room = [
            'name' => $name,
            'expired_at' => now()->addMinutes(5),
            'hidden' => $hidden,
        ];

        return $this->createOrUpdate($room);
    }

    protected function createOrUpdate(array $data): array
    {
        $this->rooms = $this->rooms->reject(function (array $room) use ($data) {
            return $room['name'] == $data['name'];
        });

        $this->rooms = $this->rooms->prepend($data);

        Cache::forever('rooms', $this->rooms);

        return $data;
    }
}
