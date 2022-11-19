<?php

namespace App\Facades;

use App\Models\Operation;
use App\Services\OperationService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @see OperationService
 *
 * @method static Operation create(Operation $model) Создать операцию
 * @method static Operation update(Operation $model, $attributes) Обновить операцию
 * @method static Builder find(array $filter) Найти операции по фильтру
 * @method static null delete(Operation $model) Удалить операцию
 *
 * @method static array confirm(Operation $operation, string $code) Подтвердить операцию
 */
class OperationManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return self::class;
    }
}
