<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendEmailRequest;
use App\Models\User;
use App\Repositories\Contracts\EmailRepositoryInterface;
use Illuminate\Http\Response;

class EmailController extends Controller
{
    public function __construct(private EmailRepositoryInterface $emailRepository)
    {
    }

    public function send(User $user, SendEmailRequest $request)
    {
        $emailsToSend = $request->emails();

        $emailsToSend->each(function ($email) use ($user) {
            $this->emailRepository->sendEmail($user, $email);
        });

        return $this->response(Response::HTTP_ACCEPTED, "{$emailsToSend->count()} email(s) processing");
    }

    public function list(User $user)
    {
        $emails = $this->emailRepository->listEmails();

        return $this->response(Response::HTTP_OK, 'Emails Retrieved', $emails);
    }
}
