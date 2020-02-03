<?php

namespace App\Texter;

class MultipleTexter implements TexterInterface
{
    protected $texters = [];

    public function addTexter(TexterInterface $texter, string $message)
    {
        $this->texters[] = [$texter, $message];
    }

    public function send(\App\Texter\Text $text)
    {
        foreach ($this->texters as $texter) {
            var_dump('PREFLIGHT : ' . $texter[1]);
            $texter[0]->send($text);
        }
    }
}
