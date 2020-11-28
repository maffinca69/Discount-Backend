<?php


namespace App\Listeners;


use App\Mail\UserRegister;
use Illuminate\Support\Facades\Mail;

class RegisterListener
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
     * @param \App\Events\UserRegister $event
     * @return void
     */
    public function handle(\App\Events\UserRegister $event)
    {
        $email = $event->user->email;
        Mail::to($email)->send(new UserRegister());
    }
}
