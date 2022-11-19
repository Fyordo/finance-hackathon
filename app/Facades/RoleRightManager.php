<?php

namespace App\Facades;

use App\Models\Role;
use App\Models\RoleRight;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @see RoleRightService
 *
 * @method static RoleRight create(RoleRight $model, User $user = null) Создать роль
 * @method static RoleRight update(RoleRight $model, $attributes, User $user = null) Обновить роль
 * @method static Collection find(array $filter, User $user = null) Найти роли по фильтру
 * @method static RoleRight delete(RoleRight $model, User $user = null) Удалить роль
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
