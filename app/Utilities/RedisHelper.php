<?php

namespace App\Utilities;

use App\Utilities\Contracts\RedisHelperInterface;

class RedisHelper implements RedisHelperInterface
{

    public function storeRecentMessage(mixed $id, string $messageSubject, string $toEmailAddress): void
    {
        // TODO: Implement storeRecentMessage() method.
    }
}
