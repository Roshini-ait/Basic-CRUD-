<?php

namespace App\Listeners;

use App\Event\UserCreated;
use App\Jobs\SendWelcomeEmailJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Event\UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        SendWelcomeEmailJob::dispatch($event->user);
        // print_r($event->email);
        // //We can send a mail from here
        // echo ".. From Listeners";
        // exit;
    }
}
