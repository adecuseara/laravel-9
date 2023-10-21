<?php

namespace App\Jobs;

use App\Services\MailService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private MailService $mailService;

    private array $emails;
    /**
     * Create a new job instance.
     */
    public function __construct(array $emails)
    {
        $this->mailService = app()->make(MailService::class);
        $this->emails = $emails;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->emails as $email) {
            $this->mailService->send($email['mail'], $email['subject'], $email['body']);
        }
    }
}
