<?php

namespace App\Models;

use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int account_from_id С какого аккаунта отправлен перевод
 * @property int account_to_id На какой аккаунт отправлен перевод
 * @property float sum Сумма перевода (в валюте счёта, с которого отправлен перевод)
 * @property float price Ориентировочный курс
 * @property \DateTime confirmed_at Когда платёж был подтверждён
 *
 * @property int created_user_id Идентификатор создателя записи
 * @property int updated_user_id Идентификатор изменения записи
 */
class Operation extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'account_from_id',
        'account_to_id',
        'sum',
        'price',
        'confirmed_at',
    ];

    public function accountFrom(){
        return $this->belongsTo(Account::class, 'id', 'account_from_id');
    }

    public function accountTo(){
        return $this->belongsTo(Account::class, 'id', 'account_to_id');
    }
}
