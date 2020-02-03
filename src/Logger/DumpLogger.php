<?php

namespace App\Logger;

class DumpLogger
{
    public function log(string $message)
    {
        var_dump("LOGGER : $message");
    }
}
