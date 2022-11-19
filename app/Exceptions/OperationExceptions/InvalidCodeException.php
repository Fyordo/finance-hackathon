<?php

namespace App\Exceptions\OperationExceptions;

class InvalidCodeException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Invalid code!');
    }
}
