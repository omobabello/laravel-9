<?php

namespace App\Utilities\Contracts;

use App\Data\EmailData;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface RedisHelperInterface {
    /**
     * Store the id of a message along with a message subject in Redis.
     *
     * @param User $user
     * @param EmailData $data
     * @return void
     */
    public function storeRecentMessage(User $user, EmailData $data): void;
}
