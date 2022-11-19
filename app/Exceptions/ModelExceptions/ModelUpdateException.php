<?php

namespace App\Exceptions\ModelExceptions;

class ModelUpdateException extends \Exception
{
    public function __construct(string $model)
    {
        parent::__construct($model . ' model not updated!');
    }
}
