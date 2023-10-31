<?php

namespace App\Jobs;

use App\Data\EmailData;
use App\Mail\CustomMail;
use App\Models\User;
use App\Utilities\Contracts\ElasticsearchHelperInterface;
use App\Utilities\Contracts\RedisHelperInterface;
use App\Utilities\ElasticsearchHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private User $user, private EmailData $email)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ElasticsearchHelperInterface $elasticsearchHelper, RedisHelperInterface $redisHelper)
    {
        Mail::to($this->email->getEmailAddress())
            ->queue(new CustomMail($this->email));
    }
}
