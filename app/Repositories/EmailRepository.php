<?php

namespace App\Repositories;

use App\Data\EmailData;
use App\Jobs\SendEmailJob;
use App\Models\User;
use App\Repositories\Contracts\EmailRepositoryInterface;
use App\Utilities\Contracts\ElasticsearchHelperInterface;
use Illuminate\Support\Arr;

class EmailRepository implements EmailRepositoryInterface
{
    public function sendEmail(User $user, EmailData $email)
    {
        SendEmailJob::dispatch($user, $email);
    }

    public function listEmails()
    {
        $elasticsearchHelper = app()->make(ElasticsearchHelperInterface::class);
        $result = $elasticsearchHelper->get();

        return Arr::pluck($result['hits']['hits'], '_source');
    }
}
