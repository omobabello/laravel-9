<?php

namespace App\Utilities\Contracts;

use App\Data\EmailData;
use App\Models\User;

interface ElasticsearchHelperInterface {
    /**
     * Store the email's message body, subject and to address inside elasticsearch.
     *
     * @param User $user
     * @param EmailData $data
     * @return mixed - Return the id of the record inserted into Elasticsearch
     */
    public function storeEmail(User $user, EmailData $data): mixed;

    public function get();

    public function getUserEmails(User $user);
}
