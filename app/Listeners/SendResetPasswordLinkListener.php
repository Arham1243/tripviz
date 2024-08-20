<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SendResetPasswordLink;
use Illuminate\Support\Facades\Mail;
use App\Models\ImageTable;

class SendResetPasswordLinkListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
     public function handle(SendResetPasswordLink $event)
    {
        $user = $event->user;
        $data = [
            'full_name' => $user->full_name,
            'verify_link' => route('reset_password', ['token' => $event->token]),
            'logo' => asset(ImageTable::where('table_name', 'logo')->latest()->first()->img_path ?? 'assets/images/logo (1).webp'),
        ];

        Mail::send('emails.reset-password', ['data' => $data], function ($message) use ($user) {
            $message->from(env('MAIL_FROM_ADDRESS'));
            $message->to($user->email)
                ->subject('Password Reset - ' . env('MAIL_FROM_NAME'));
        });
    }
}
