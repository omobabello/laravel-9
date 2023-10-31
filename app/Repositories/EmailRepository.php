<?php

namespace App\Repositories;

use App\Data\EmailData;
use App\Models\User;
use App\Repositories\Contracts\EmailRepositoryInterface;

class EmailRepository implements EmailRepositoryInterface
{

    public function sendEmail(User $user, EmailData $email)
    {
        // TODO: Implement sendEmail() method.
    }

    public function listUserEmails(User $user)
    {
        // TODO: Implement listUserEmails() method.
    }
}
