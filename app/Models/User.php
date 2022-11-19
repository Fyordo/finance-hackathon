<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @method static self create(array $properties)
 *
 * @property string name Имя пользователя
 * @property string email Почта пользователя
 * @property string phone Телефон пользователя
 * @property int role_id Идентификатор роли пользователя
 * @property Role role Идентификатор роли пользователя
 *
 * @property int created_user_id Идентификатор создателя записи
 * @property int updated_user_id Идентификатор изменения записи
 */
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function scopeFilter(Builder $query, array $filter){
        foreach ($filter as $key => $value) {
            switch ($key) {
                case 'id':
                    if ($value) {
                        $query
                            ->where('id', '=', $value);
                    }
                    break;
                case 'search':
                    if ($value) {
                        $query
                            ->where('email', 'ILIKE', '%' . $value . '%')
                            ->orWhere('name', 'ILIKE', '%' . $value . '%')
                            ->orWhere('phone', 'ILIKE', '%' . $value . '%');
                    }
                    break;
            }
        }
    }
}
