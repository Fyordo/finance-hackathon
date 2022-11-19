<?php

namespace App\Exceptions\ModelExceptions;

class ModelFilterException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Filter error!');
    }
}
