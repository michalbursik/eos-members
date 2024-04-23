<?php

namespace Modules\Member\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Member\Interfaces\MemberRepositoryInterface;
use Modules\Member\Repositories\MemberRepository;

class MemberServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->mergeConfigFrom(__DIR__.'/../../config/config.php', 'member');

        $this->app->register(RouteServiceProvider::class);

        $this->app->singleton(MemberRepositoryInterface::class, function () {
            return new MemberRepository();
        });
    }
}
