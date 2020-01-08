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

    protected $user;
    protected $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, string $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.holiday-requests-submitted')
            ->from('humanres321@gmail.com')
            ->subject($this->user->firstname . ': submitted requests')
            ->with([
                'user'   => $this->user,
                'message' => $this->message,
            ]);
    }
}
