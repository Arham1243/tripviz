<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\View;

class ShareAdminNotifications
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Check if the admin is authenticated
        if (auth()->guard('admin')->check()) {
            $admin = auth()->guard('admin')->user();

            $unreadNotifications = $admin->unreadNotifications;
            $readNotifications = $admin->readNotifications;

            $notifications = $unreadNotifications->merge($readNotifications);

            View::share('notifications', $notifications);
            View::share('unreadNotifications', $unreadNotifications);
        }

        return $next($request);
    }
}
