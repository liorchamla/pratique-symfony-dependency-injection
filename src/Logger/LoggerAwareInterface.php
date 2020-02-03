<?php

namespace App\Logger;

interface LoggerAwareInterface
{
    public function setLogger(DumpLogger $logger);
}
