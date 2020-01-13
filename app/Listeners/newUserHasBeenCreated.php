<?php

namespace App\Listeners;

use App\Events\sendUserActivationEmail;
use App\Mail\userAccountActivation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class newUserHasBeenCreated
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
     * @param  sendUserActivationEmail  $event
     * @return void
     */
    public function handle(sendUserActivationEmail $event)
    {
        Mail::to($event->user->email)->send(new userAccountActivation($event->user));
    }
}
