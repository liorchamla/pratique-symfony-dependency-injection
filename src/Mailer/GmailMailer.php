<?php

namespace App\Mailer;

use App\Logger\LoggerAwareInterface;

class GmailMailer implements MailerInterface, LoggerAwareInterface
{

    protected $user;
    protected $password;
    protected $logger;

    public function __construct(string $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function setLogger(\App\Logger\DumpLogger $logger)
    {
        $this->logger = $logger;
    }

    public function send(Email $email)
    {
        $this->logger->log("LOGGER DANS LE GMAILMAILER, VIVE LES COMPILERPASSES !");
        var_dump("ENVOI VIA GMAILMAILER", $email);
    }
}
