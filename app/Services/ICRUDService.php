<?php

namespace App\Services;

interface ICRUDService
{
    public function create($model);

    public function find($filter);

    public function update($model, $attributes);

    public function delete($model);
}
