<?php

namespace App\Exceptions\ModelExceptions;

class ModelDeleteException extends \Exception
{
    public function __construct(string $model)
    {
        parent::__construct($model . ' model not deleted!');
    }
}
