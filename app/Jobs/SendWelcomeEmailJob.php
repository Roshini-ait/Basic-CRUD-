<?php

namespace App\Jobs;

use App\Mail\CustomEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailJob
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        // Logic to send email
        Mail::to($this->user->email)->send(new CustomEmail($this->user));
    }

    // Manually dispatch method
    public static function dispatch($user)
    {
        $job = new static($user);

        // Run synchronously or dispatch to queue manually
        $job->handle();
    }
}
