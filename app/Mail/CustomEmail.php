<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Custom Email Subject')
                    ->view('email.custom-template')
                    ->with('details', $this->details);
                    // ->attach(public_path('files/example.pdf'));
                    // ->attachData($this->details['file_data'], 'dynamic-file.pdf', [
                    //     'mime' => 'application/pdf',
                    // ]);
    }
}
