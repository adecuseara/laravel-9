<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendMailRequest;
use App\Http\Resources\EmailsResource;
use App\Models\User;
use App\Services\MailService;
use Illuminate\Http\JsonResponse;

class EmailController extends Controller
{
    private MailService $mailService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    /**
     * Send mail to user
     *
     * @param User $user
     *
     * @return JsonResponse
     */
    public function send(User $user, SendMailRequest $request): JsonResponse
    {
        $emails = $request->safe()->only('emails')['emails'];
        $success = $this->mailService->sendBatch($emails);
        if ($success) {
            $storedEmails = $this->mailService->storeInElasticsearch($emails);
            $this->mailService->storeInRedisRecentMessages($storedEmails);
            return response()->json(['message' => __('mail.send')], 200);
        }
        return response()->json(['message' => __('mail.send_failed')], 400);
    }

    /**
     * Resturn a list with all emails sent
     *
     * @return void
     */
    public function list(): EmailsResource
    {
        $emails = $this->mailService->getAllEmailsSent();
        return new EmailsResource($emails);
    }
}
