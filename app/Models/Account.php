<?php

namespace App\Models;

use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int currency_id Идентификатор валюты счёта
 * @property Currency currency Валюта счёта
 * @property float amount Сумма
 * @property int user_id Идентификатор владельца счёта
 * @property User user Владелец счёта
 * @property Collection incomeOperations Входящие операции
 * @property Collection outcomeOperations Исходящие операции
 *
 * @property int created_user_id Идентификатор создателя записи
 * @property int updated_user_id Идентификатор изменения записи
 */
class Account extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'currency_id',
        'amount',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function currency(){
        return $this->belongsTo(Currency::class);
    }

    public function incomeOperations(){
        return $this->hasMany(Operation::class, 'account_to_id', 'id');
    }

    public function outcomeOperations(){
        return $this->hasMany(Operation::class, 'account_from_id', 'id');
    }
}
