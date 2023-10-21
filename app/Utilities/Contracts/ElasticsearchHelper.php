<?php

namespace App\Utilities\Contracts;

interface ElasticsearchHelper
{
    /**
     * Store the email's message body, subject and to address inside elasticsearch.
     *
     * @param  string  $messageBody
     * @param  string  $messageSubject
     * @param  string  $toEmailAddress
     *
     * @return array - Return the id and related info stored into Elasticsearch
     */
    public function storeEmail(string $messageBody, string $messageSubject, string $toEmailAddress): array;

    /**
     * Get All stored emails
     *
     * @return array - Return stored emails
     */
    public function getAll(): array;
}
