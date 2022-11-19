<?php

namespace App\Services;

use App\Models\User;

interface ICRUDService
{
    public function create($model, User $user = null);

    public function find($filter, User $user = null);

    public function update($model, $attributes, User $user = null);

    public function delete($model, User $user = null);
}
