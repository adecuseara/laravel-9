<?php

namespace App\Services;

use App\Utilities\Contracts\ElasticsearchHelper;

class ElasticsearchService
{
    private ElasticsearchHelper $elasticsearchHelper;

    public function __construct(ElasticsearchHelper $elasticsearchHelper)
    {
        $this->elasticsearchHelper = $elasticsearchHelper;
    }

    /**
     * Store emails in elasticsearch
     *
     * @param array $emails
     *
     * @return array
     */
    public function store(array $emails): array
    {
        $storedIds = [];
        foreach ($emails as $email) {
            $storedIds[] = $this->elasticsearchHelper->storeEmail($email['body'], $email['subject'], $email['mail']);
        }
        return $storedIds;
    }

    /**
     * Get all emails
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->elasticsearchHelper->getAll();
    }
}
