<?php

namespace App\Utilities;

use App\Data\EmailData;
use App\Models\User;
use App\Utilities\Contracts\ElasticsearchHelperInterface;
use Elasticsearch\Client;

class ElasticsearchHelper implements ElasticsearchHelperInterface
{
    public function __construct(private Client $client){

    }

    public function storeEmail(User $user, EmailData $data): mixed
    {
       return $this->client->index([
            'index' => 'emails',
            'type' => 'array',
            'id' => $data->getId(),
            'body' => [
                'sender_name' => $user->name,
                'sender_id' => $user->id,
                'created_at' => now()->format('Y-m-d H:i:s'),
                ...$data->toArray(),
            ]
       ]);
    }

    public function get()
    {
        return $this->client->get();
    }

    public function getUserEmails(User $user)
    {
        // TODO: Implement getUserEmails() method.
    }
}
