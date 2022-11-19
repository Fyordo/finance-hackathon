<?php

namespace App\Models;

use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static self create(array $properties)
 * @method static self find(int $id)
 *
 * @property string title Название роли
 * @property string const Константное название роли
 * @property Collection users Пользователи с этой ролью
 *
 * @property int created_user_id Идентификатор создателя записи
 * @property int updated_user_id Идентификатор изменения записи
 */
class Role extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'const'
    ];

    public const ADMIN_ROLE = 'ADMIN';
    public const MODERATOR_ROLE = 'MODERATOR';
    public const CLIENT_ROLE = 'CLIENT';

    /**
     * Пользователи с данной ролью
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
