<?php

namespace App\Providers;

use App\Repositories\Contracts\EmailRepositoryInterface;
use App\Repositories\EmailRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(EmailRepositoryInterface::class, EmailRepository::class);
    }
}
