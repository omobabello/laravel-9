<?php

namespace App\Utilities;

use App\Utilities\Contracts\ElasticsearchHelperInterface;

class ElasticsearchHelper implements ElasticsearchHelperInterface
{

    public function storeEmail(string $messageBody, string $messageSubject, string $toEmailAddress): mixed
    {
        // TODO: Implement storeEmail() method.
    }
}
