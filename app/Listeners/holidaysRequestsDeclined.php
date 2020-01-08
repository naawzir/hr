<?php

namespace App\Listeners;

use App\Events\sendEmailToEmployee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class holidaysRequestsDeclined
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
     * @param  sendEmailToEmployee  $event
     * @return void
     */
    public function handle(sendEmailToEmployee $event)
    {
        \Mail::raw($event->text, function ($message, $event) {
            $message->from('humanres321@gmail.com', 'Human Resource System (Riz & Greg)');
            $message->subject('Holiday requests declined');
            $message->to($event->user->email);
        });
    }
}
