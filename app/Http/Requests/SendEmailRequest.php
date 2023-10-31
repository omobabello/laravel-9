<?php

namespace App\Http\Requests;

use App\Data\EmailData;
use Illuminate\Foundation\Http\FormRequest;

class SendEmailRequest extends FormRequest
{
    public function rules()
    {
        return [
            'emails' => 'required|array|min:1',
            'emails.*.subject' => 'required|string|min:3',
            'emails.*.body' => 'required|string|min:10',
            'emails.*.email' => 'required|email',
        ];
    }

    public function emails()
    {
        $user = $this->route('user');

        $emails = collect($this->input('emails', []));
        $emails->transform(function ($email) use ($user) {
            $emailData = new EmailData();
            $emailData->setEmailAddress($email['email'])
                ->setSubject($email['subject'])
                ->setBody($email['body'])
                ->setSenderId($user->id)
                ->setSenderName($user->name);

            return $emailData;
        });

        return $emails;
    }
}
