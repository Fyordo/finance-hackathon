<?php

namespace App\Exceptions\ModelExceptions;

class ModelReadException extends \Exception
{
    public function __construct(string $model)
    {
        parent::__construct($model . ' model not found!');
    }
}
