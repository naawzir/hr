<?php

namespace App\Listeners;

use App\Events\sendEmailToHR;
use App\Mail\emailHRHolidayRequestsSubmitted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class submitHolidayRequests
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
     * @param  sendEmailToHR  $event
     * @return void
     */
    public function handle(sendEmailToHR $event)
    {
        \Mail::to('humanres321@gmail.com')->send(new emailHRHolidayRequestsSubmitted($event->user, $event->message));
    }
}
