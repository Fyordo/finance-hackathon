<?php

namespace App\Models;

use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int currency_id Идентификатор валюты счёта
 * @property Currency currency Валюта счёта
 * @property float amount Сумма
 * @property int user_id Идентификатор владельца счёта
 * @property User user Владелец счёта
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
}
