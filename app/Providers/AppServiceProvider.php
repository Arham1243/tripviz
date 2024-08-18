<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Events\Dispatcher;
use App\Events\SendVerificationEmail;
use App\Listeners\SendVerificationEmailListener;
use App\Events\SendResetPasswordLink;
use App\Listeners\SendResetPasswordLinkListener;

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
