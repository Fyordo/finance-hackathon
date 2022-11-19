<?php

namespace App\Exceptions\OperationExceptions;

class InvalidSumException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Invalid sum!');
    }
}
