<?php

namespace App\Mailer;

interface MailerInterface
{
    public function send(Email $email);
}
