<?php

namespace App\Repositories\Contracts;

use App\Data\EmailData;
use App\Models\User;

interface EmailRepositoryInterface
{
    public function sendEmail(User $user, EmailData $email);

    public function listEmails();
}
