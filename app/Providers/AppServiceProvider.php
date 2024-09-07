<?php

namespace App\Providers;

use App\Events\SendResetPasswordLink;
use App\Events\SendVerificationEmail;
use App\Listeners\SendResetPasswordLinkListener;
use App\Listeners\SendVerificationEmailListener;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Dispatcher $events): void
    {
        $events->listen(
            SendVerificationEmail::class,
            SendVerificationEmailListener::class
        );

        $events->listen(
            SendResetPasswordLink::class,
            SendResetPasswordLinkListener::class
        );
    }
}
