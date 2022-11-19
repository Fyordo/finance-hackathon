<?php

namespace App\Exceptions;

class RightException extends \Exception
{
    public function __construct(string $type)
    {
        parent::__construct('Access for ' . $type . ' denied!');
    }
}
