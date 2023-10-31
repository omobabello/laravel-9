<?php

namespace App\Utilities;

use App\Data\EmailData;
use App\Models\User;
use App\Utilities\Contracts\RedisHelperInterface;
use Illuminate\Support\Facades\Cache;

class RedisHelper implements RedisHelperInterface
{

    public function storeRecentMessage(User $user, EmailData $data): void
    {
        Cache::set($user->getRedisKey(), json_encode($data->toArray()));
    }
}
