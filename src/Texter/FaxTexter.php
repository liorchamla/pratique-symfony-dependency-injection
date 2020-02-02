<?php

namespace App\Texter;

class FaxTexter implements TexterInterface
{
    public function send(Text $text)
    {
        var_dump("ENVOI D'UN FAX :", $text);
    }
}
