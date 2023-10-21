<?php

namespace Tests\Unit;

use App\Mail\SendUserMail;
use App\Services\MailService;
use Tests\TestCase;

class FullTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function testSend()
    {
        $mailService = app(MailService::class);
        $email = 'test@example.com';
        $subject = 'Test Subject';
        $body = 'Test Body';

        $result = $mailService->send($email, $subject, $body);

        $this->assertTrue($result);
    }

    /**
     * Unit test -> assert code in mail
     *
     * @return void
     */
    public function testMailContent(): void
    {
        $mailService = app(MailService::class);
        $email = 'test@example.com';
        $subject = 'Test Subject';
        $body = 'Test Body';

        $mailService->send($email, $subject, $body);
        $mail = new SendUserMail($subject, $body);
        $mail->assertSeeInHtml($body);
    }
}
