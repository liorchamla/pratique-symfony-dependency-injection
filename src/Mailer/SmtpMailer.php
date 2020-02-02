<?php

namespace App\Mailer;

class SmtpMailer implements MailerInterface
{

    protected $dsn;
    protected $user;
    protected $password;

    public function __construct(string $dsn, string $user, string $password)
    {
        $this->dsn = $dsn;
        $this->user = $user;
        $this->password = $password;
    }

    public function send(Email $email)
    {
        var_dump("ENVOI VIA SMTPMAILER ($this->dsn)", $email);
    }
}
