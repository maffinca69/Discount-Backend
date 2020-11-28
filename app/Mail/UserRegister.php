<?php


namespace App\Mail;


use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRegister extends Mailable
{
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $token = md5(Str::random());

        return $this
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('emails.test')
            ->subject('Подтверждение почты')
            ->with(['token' => $token]);
    }
}
