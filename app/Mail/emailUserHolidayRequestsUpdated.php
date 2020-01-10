<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class emailUserHolidayRequestsUpdated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = 'Holiday request/s have been updated.';
        $subject = 'Holidays requests updated';
        return $this->view('email.holiday-requests-updated')
            ->from('humanres321@gmail.com')
            ->subject($subject)
            ->with([
                'text' => $message,
            ]);
    }
}
