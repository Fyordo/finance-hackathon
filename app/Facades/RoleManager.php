<?php

namespace App\Facades;

use App\Models\Role;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @see RoleService
 *
 * @method static Role create(Role $model, User $user = null) Создать роль
 * @method static Role update(Role $model, $attributes, User $user = null) Обновить роль
 * @method static Collection find(array $filter, User $user = null) Найти роли по фильтру
 * @method static null delete(Role $model, User $user = null) Удалить роль
 */
class RoleManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return self::class;
    }
}
