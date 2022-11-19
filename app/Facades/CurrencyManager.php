<?php

namespace App\Facades;

use App\Models\Currency;
use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @see CurrencyService
 *
 * @method static Currency create(Currency $model) Создать валюту
 * @method static Currency update(Currency $model, $attributes) Обновить валюту
 * @method static Builder find(array $filter) Найти валюту по фильтру
 * @method static null delete(Currency $model) Удалить валюту
 */
class CurrencyManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return self::class;
    }
}
