<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static self create(array $properties)
 * @method static self find(int $id)
 *
 * @property int role_id Идентификатор роли
 * @property string model Модель
 * @property bool create Права на создание
 * @property bool read Права на чтение
 * @property bool update Права на обновление
 * @property bool delete Права на удаление
 *
 * @property Role role Роль
 *
 * @property int created_user_id Идентификатор создателя записи
 * @property int updated_user_id Идентификатор изменения записи
 */
class RoleRight extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'role_id',
        'model',
        'create',
        'read',
        'update',
        'delete'
    ];

    public const CREATE_RIGHT = 'create';
    public const READ_RIGHT = 'read';
    public const UPDATE_RIGHT = 'update';
    public const DELETE_RIGHT = 'delete';

    public function role(): HasOne
    {
        return $this->hasOne(Role::class);
    }
}
