<?php

namespace Tests\Feature;

use App\Jobs\SendEmailJob;
use App\Mail\CustomMail;
use App\Models\User;
use App\Repositories\EmailRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class EmailControllerTest extends TestCase
{

    public function test_email_job_is_dispatch_if_payload_is_valid()
    {
        $user = User::factory()->create();

        Queue::fake();
        Queue::assertNothingPushed();

        $response = $this->postJson($this->link("{$user->id}/send?api_token={$user->api_token}"), [
            "emails" => [
                [
                    "email" => fake()->safeEmail(),
                    "body" => "The quick brown lazy fox is here",
                    "subject" => fake()->sentence()
                ],
                [
                    "email" => fake()->safeEmail(),
                    "body" => "Everybody loves the blue sky",
                    "subject" => fake()->sentence()
                ]
            ]
        ]);

        Queue::assertPushed(SendEmailJob::class);

        $response->assertStatus(Response::HTTP_ACCEPTED);

        $response_body = $response->decodeResponseJson();
        $this->assertArrayHasKey('message', $response_body);
        $this->assertEquals("2 email(s) processing", $response_body['message']);
    }

    public function test_validation_error_if_payload_is_invalid()
    {
        $user = User::factory()->create();

        $response = $this->postJson($this->link("{$user->id}/send?api_token={$user->api_token}"), [
            "emails" => [
                [
                    "email" => fake()->safeEmail(),
                    "subject" => fake()->sentence()
                ]
            ]
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response_body = $response->decodeResponseJson();
        $this->assertArrayHasKey('message', $response_body);
        $this->assertEquals("Validation error", $response_body['message']);

    }

    public function test_can_get_list_of_emails()
    {
        $user = User::factory()->create();

        Queue::fake();
        Queue::assertNothingPushed();

        $this->postJson($this->link("{$user->id}/send?api_token={$user->api_token}"), [
            "emails" => [
                [
                    "email" =>  fake()->safeEmail(),
                    "body" => $body = "The quick brown lazy fox is here",
                    "subject" => $subject = fake()->sentence()
                ],
            ]
        ]);

        Queue::assertPushed(SendEmailJob::class);

        $response = $this->getJson($this->link('list'));
        $response->assertOk();

        $response_body = $response->decodeResponseJson();
        $this->assertArrayHasKey('message', $response_body);
        $this->assertEquals("Emails Retrieved", $response_body['message']);
        $this->assertArrayHasKey('data', $response_body);
    }

    private function link($link)
    {
        return "api/{$link}";
    }
}
