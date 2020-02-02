<?php

namespace App\Texter;

class SmsTexter implements TexterInterface
{
    protected $serviceDsn;
    protected $key;

    public function __construct(string $serviceDsn, string $key)
    {
        $this->serviceDsn = $serviceDsn;
        $this->key = $key;
    }

    public function send(Text $text)
    {
        var_dump("ENVOI DE SMS : ", $text);
    }
}
