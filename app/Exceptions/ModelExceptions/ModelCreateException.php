<?php

namespace App\Exceptions\ModelExceptions;

class ModelCreateException extends \Exception
{
    public function __construct(string $model)
    {
        parent::__construct($model . ' model not created!');
    }
}
