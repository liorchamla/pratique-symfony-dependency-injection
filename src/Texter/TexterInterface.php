<?php

namespace App\Texter;

interface TexterInterface
{
    public function send(Text $text);
}
