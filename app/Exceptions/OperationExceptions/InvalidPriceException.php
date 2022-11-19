<?php

namespace App\Exceptions\OperationExceptions;

class InvalidPriceException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Invalid price!');
    }
}
