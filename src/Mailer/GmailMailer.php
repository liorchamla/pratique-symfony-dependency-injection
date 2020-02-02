<?php

namespace App\Mailer;

class GmailMailer implements MailerInterface
{

    protected $user;
    protected $password;

    public function __construct(string $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function send(Email $email)
    {
        var_dump("ENVOI VIA GMAILMAILER", $email);
    }
}
