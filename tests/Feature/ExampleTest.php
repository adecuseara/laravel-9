<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use Elasticsearch;

class ExampleTest extends TestCase
{
    /**
     * Check validation body success
     *
     * @return void
     */
    public function testValidationsForSendEmailsSuccessCase()
    {
        $user = User::factory()->create();
        $response = $this->postJson("api/{$user->id}/token");
        $response = $this->postJson("api/{$user->id}/send?api_token=" . $response->json()['token'], [
            'emails' => [
                [
                    "mail" =>  "test@andrei.com",
                    "subject" => "Test",
                    "body" => "How are you?"
                ],
                [
                    "mail" =>  "andrei@andrei.com",
                    "subject" => "Andrei",
                    "body" => "How are you?"
                ]
            ]
        ]);

        $response->assertStatus(200)
            ->assertJson(['message' => __('mail.send')]);
    }
    /**
     * Check validation body fail case
     *
     * @return void
     */
    public function testValidationsForSendEmailsFailCase()
    {
        $user = User::factory()->create();
        $response = $this->postJson("api/{$user->id}/token");
        $response = $this->postJson("api/{$user->id}/send?api_token=" . $response->json()['token'], [
            'emails' => ['test@example.com']
        ]);

        $response->assertStatus(422);
    }

    /**
     * Check validation body fail case token
     *
     * @return void
     */
    public function testValidationsForSendEmailsFailCaseToken()
    {
        $user = User::factory()->create();
        $token = Str::random(12);
        $response = $this->postJson("api/{$user->id}/send?api_token=" . $token, [
            'emails' => ['test@example.com']
        ]);

        $response->assertStatus(403);
    }

    /**
     * Check list endpoint
     *
     * @return void
     */
    public function testValidationsForListEmails()
    {

        $data = [
            'index' => config('elasticsearch.index'),
            'body' => [
                "mail" =>  "andrei@andrei.com",
                "subject" => "Andrei",
                "body" => "How are you?"
            ],
        ];
        Elasticsearch::index($data);

        $response = $this->getJson("api/list");
        $response->assertStatus(200)
            ->assertJsonFragment(
                [
                    "mail" =>  "andrei@andrei.com",
                ]
            );
    }
}
