<?php

namespace App\Models;

use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static self create(array $properties)
 * @method static self find(int $id)
 *
 * @property string title Название валюты
 * @property string const Код валюты
 * @property string icon Ссылка на иконку валюты
 * @property Collection accounts Аккаунты, использующие эту валюту
 *
 * @property int created_user_id Идентификатор создателя записи
 * @property int updated_user_id Идентификатор изменения записи
 */
class Currency extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'const',
        'icon',
    ];

    public function accounts(){
        return $this->hasMany(Account::class);
    }
}
