<?php

namespace App\Services;

use App\Models\User;

interface ICRUDService
{
    public function create($model);

    public function find($filter);

    public function update($model, $attributes);

    public function delete($model);
}
