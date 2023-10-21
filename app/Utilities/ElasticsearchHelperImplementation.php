<?php

namespace App\Utilities;

use App\Utilities\Contracts\ElasticsearchHelper;
use Elasticsearch;

class ElasticsearchHelperImplementation implements ElasticsearchHelper
{
    private string $index;

    public function __construct()
    {
        $this->index = config('elasticsearch.index');
    }

    /**
     * Store the email's message body, subject and to address inside elasticsearch.
     *
     * @param  string  $messageBody
     * @param  string  $messageSubject
     * @param  string  $toEmailAddress
     *
     * @return array - Return the id and related info stored into Elasticsearch
     */
    public function storeEmail(string $messageBody, string $messageSubject, string $toEmailAddress): array
    {
        $data = [
            'index' => $this->index,
            'body' => [
                'body' => $messageBody,
                'subject' => $messageSubject,
                'mail' => $toEmailAddress,
            ],
        ];
        $store = Elasticsearch::index($data);

        $returnData['id'] = $store['_id'];
        $returnData['messageSubject'] = $messageSubject;
        $returnData['toEmailAddress'] = $toEmailAddress;

        return $returnData;
    }

    /**
     * Get All stored emails
     *
     * @return array - Return stored emails
     */
    public function getAll(): array
    {
        $params = [
            'index' => $this->index,
        ];
        $data = Elasticsearch::search($params);
        return array_map(function ($hit) {
            return $hit['_source'];
        }, $data['hits']['hits']);
    }
}
