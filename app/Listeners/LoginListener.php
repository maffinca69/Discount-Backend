<?php


namespace App\Listeners;


use App\Events\UserLogin;
use Carbon\Carbon;

class LoginListener
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
     * @param UserLogin $event
     * @return void
     */
    public function handle(UserLogin $event)
    {
        $event->user->update(['last_seen_at' => Carbon::now()]);
    }
}
