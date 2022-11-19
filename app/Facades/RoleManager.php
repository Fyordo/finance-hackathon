<?php

namespace App\Facades;

use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @see RoleService
 *
 * @method static Role create(Role $model) Создать роль
 * @method static Role update(Role $model, $attributes) Обновить роль
 * @method static Collection find(array $filter) Найти роли по фильтру
 * @method static null delete(Role $model) Удалить роль
 */
class RoleManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return self::class;
    }
}
