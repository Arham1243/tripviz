<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SendVerificationEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\ImageTable;

class SendVerificationEmailListener
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
    public function handle(SendVerificationEmail $event)
    {
        $user = $event->user;
        $data = [
            'full_name' => $user->full_name,
            'verify_link' => route('verify.email', ['token' => $user->email_verification_token]),
            'logo' => asset(ImageTable::where('table_name', 'logo')->latest()->first()->img_path ?? 'assets/images/logo (1).webp'),
        ];

        Mail::send('emails.verify-email', ['data' => $data], function ($message) use ($user) {
            $message->from(env('MAIL_FROM_ADDRESS'));
            $message->to($user->email);
            $message->subject('Please Verify Your Email Address - ' . env('MAIL_FROM_NAME'));
        });
    }
}
