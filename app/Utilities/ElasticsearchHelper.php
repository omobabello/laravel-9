<?php

namespace App\Utilities;

use App\Data\EmailData;
use App\Models\User;
use App\Utilities\Contracts\ElasticsearchHelperInterface;
use Elasticsearch\Client;

class ElasticsearchHelper implements ElasticsearchHelperInterface
{
    public function __construct(private Client $client)
    {

    }

    public function storeEmail(EmailData $data): mixed
    {
        return $this->client->index([
            'index' => $this->getIndex(),
            'type' => $this->getType(),
            'id' => $data->getId(),
            'body' => $data->toArray()
        ]);
    }

    public function get()
    {
        return $this->client->search([
            'index' => $this->getIndex(),
            'type' => $this->getType(),
        ]);
    }

    public function getIndex(): string
    {
        return 'emails';
    }

    public function getType(): string
    {
        return 'array';
    }
}
