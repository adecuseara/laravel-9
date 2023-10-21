<?php

namespace App\Services;

use App\Jobs\SendEmails;
use App\Mail\SendUserMail;
use Illuminate\Support\Facades\Mail;
use Throwable;

class MailService
{
    private Mail $mailProvider;
    private RedisService $redisService;
    private ElasticsearchService $elasticsearchService;

    public function __construct(
        Mail $mailProvider,
        RedisService $redisService,
        ElasticsearchService $elasticsearchService
    ) {
        $this->mailProvider = $mailProvider;
        $this->elasticsearchService = $elasticsearchService;
        $this->redisService = $redisService;
    }

    /**
     * Send multiple mails
     *
     * @param string $email
     *
     * @return bool
     */
    public function sendBatch(array $emails): bool
    {
        try {
            SendEmails::dispatch($emails)->onQueue('default');
            return true;
        } catch (Throwable $e) {
            \Log::error($e);
            return false;
        }
    }
    /**
     * Send mail to a specific user
     *
     * @param string $email
     *
     * @return bool
     */
    public function send(string $email, string $subject, string $body): bool
    {
        $sent = $this->mailProvider::to($email)->send(new SendUserMail($subject, $body));
        if (! $sent) {
            \Log::error("Mail(App\Mail\SendUserMail) not sent for {$email}");
            return false;
        }

        return true;
    }

    /**
     * Store emails in elasticsearch
     *
     * @param array $emails
     *
     * @return array
     */
    public function storeInElasticsearch(array $emails): array
    {
        return $this->elasticsearchService->store($emails);
    }

    /**
     * Store recent messages into redis
     *
     * @param array $storedEmails
     *
     * @return void
     */
    public function storeInRedisRecentMessages(array $storedEmails): void
    {
        $this->redisService->clear();
        $this->redisService->store($storedEmails);
    }

    /**
     * Get emails stored in elasticsearch
     *
     * @return array
     */
    public function getAllEmailsSent(): array
    {
        return $this->elasticsearchService->getAll();
    }
}
