<?php

namespace App\Facades;

use App\Models\Role;
use App\Models\RoleRight;
use App\Services\RoleService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @see RoleRightService
 *
 * @method static RoleRight create(RoleRight $model) Создать роль
 * @method static RoleRight update(RoleRight $model, $attributes) Обновить роль
 * @method static Collection find(array $filter) Найти роли по фильтру
 * @method static RoleRight delete(RoleRight $model) Удалить роль
 *
 * @method static bool haveAccess(Role $role, string $modelClass, string $type) Проверить, есть ли у этой роли права на эту модель
 */
class RoleRightManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return self::class;
    }
}
