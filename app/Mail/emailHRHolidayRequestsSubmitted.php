<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class emailHRHolidayRequestsSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = 'Holiday request/s have been submitted.';
        $subject = 'Holidays submitted';
        return $this->view('email.holiday-requests-submitted')
            ->from('humanres321@gmail.com')
            ->subject($subject)
            ->with([
                'text' => $message,
            ]);
    }
}
