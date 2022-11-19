<?php

namespace App\Facades;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @see UserService
 *
 * @method static User create(User $model) Создать роль
 * @method static User update(User $model, $attributes) Обновить роль
 * @method static Collection find(array $filter) Найти роли по фильтру
 * @method static null delete(User $model) Удалить роль
 */
class UserManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return self::class;
    }
}
