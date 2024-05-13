<?php

namespace App;

class CustomAuth
{
    public function __construct(public array $user) {}

    public function getData() {
        return $this->user;
    }

    public function getAuthIdentifierForBroadcasting() {
        return $this->user['id'] ?? null;
    }
}
