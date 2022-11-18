<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static void create(array $properties)
 *
 * @property string title Название роли
 * @property string const Константное название роли
 * @property Collection users Пользователи с этой ролью
 */
class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'const'
    ];

    /**
     * Пользователи с данной ролью
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
