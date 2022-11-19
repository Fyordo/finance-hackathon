<?php

namespace App\Facades;

use App\Models\Account;
use App\Services\AccountService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @see AccountService
 *
 * @method static Account create(Account $model) Создать счёт
 * @method static Account update(Account $model, $attributes) Обновить счёт
 * @method static Builder find(array $filter) Найти счёт по фильтру
 * @method static null delete(Account $model) Удалить счёт
 */
class AccountManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return self::class;
    }
}
