<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\CustomEmail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendEmailToUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email to the logged-in user every 5 minutes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userId = 1;
        $user = User::find($userId);

        if ($user) {
            Mail::to($user->email)->send(new CustomEmail($user));
            $this->info('Email sent to ' . $user->email);
        } else {
            $this->error('No user is currently logged in.');
        }
    }
    
}
