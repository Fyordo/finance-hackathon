<?php

namespace App\Models\Traits;

use App\Facades\UserManager;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

/**
 * @method static Builder filter(array $filter)
 * @method static Builder forUser(User|Authenticatable $user)
 */
trait Searchable
{
    /**
     * Кастомный фильтр для модели
     *
     * @param Builder $query
     * @param array $filter
     * @return void
     */
    public function scopeFilter(Builder $query, array $filter)
    {
        foreach ($filter as $key => $value) {
            if ((in_array($key, $this->fillable) || $key == 'id') && !empty($value)) {
                $query->whereIn($key, is_array($value) ? $value : [$value]);
            }
        }
    }

    /**
     * Получить записи, принадлежащие напрямую пользователю
     *
     * @param Builder $query
     * @param User $user
     * @return void
     */
    public function scopeForUser(Builder $query, User $user)
    {
        $query
            ->orWhere('created_user_id', '=', $user->id);
    }
}
