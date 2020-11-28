<?php


namespace App\Events;


use App\Models\User;

class UserRegister
{
    /** @var User */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
