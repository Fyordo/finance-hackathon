<?php

namespace App\Services;

use App\Exceptions\ModelExceptions\ModelCreateException;
use App\Exceptions\ModelExceptions\ModelDeleteException;
use App\Exceptions\ModelExceptions\ModelReadException;
use App\Exceptions\ModelExceptions\ModelUpdateException;
use App\Exceptions\RightException;
use App\Models\Account;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AccountService implements ICRUDService
{
    /**
     * @param Account $model
     * @return Account
     * @throws \App\Exceptions\ModelExceptions\ModelCreateException
     */
    public function create($model): Account
    {
        try {
            $model->user()->associate(Auth::user());
            $model->save();

            return $model;
        } catch (\Exception $exception){
            throw new ModelCreateException(Account::class);
        }
    }

    /**
     * @param Account $model
     * @param $attributes
     * @return Account
     * @throws ModelUpdateException|\App\Exceptions\ModelExceptions\ModelReadException
     */
    public function update($model, $attributes): Account
    {
        if ($model->created_user_id !== Auth::id()){
            throw new RightException('update');
        }
        if ($model) {
            try {
                if ($attributes['amount'] && $attributes['amount'] < 0){
                    $attributes['amount'] = 0;
                }
                $model->update($attributes);

                return $model;
            } catch (\Exception $exception){
                throw new ModelUpdateException(Account::class);
            }
        }
        else{
            throw new ModelReadException(Account::class);
        }
    }

    /**
     * @param array $filter
     * @return Builder
     * @throws \App\Exceptions\ModelExceptions\ModelReadException|\App\Exceptions\ModelExceptions\ModelFilterException
     */
    public function find($filter) : Builder
    {
        return Account::forUser(Auth::user())->filter($filter);
    }

    /**
     * @param Account $model
     * @return void
     * @throws ModelDeleteException
     */
    public function delete($model)
    {
        if ($model->created_user_id !== Auth::id()){
            throw new RightException('delete');
        }
        try {
            $model->delete();
        } catch (\Exception $exception){
            throw new ModelDeleteException(Account::class);
        }
    }
}
