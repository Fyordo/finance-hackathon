<?php

namespace App\Services;

use App\Exceptions\ModelExceptions\ModelCreateException;
use App\Exceptions\ModelExceptions\ModelDeleteException;
use App\Exceptions\ModelExceptions\ModelReadException;
use App\Exceptions\ModelExceptions\ModelUpdateException;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class CurrencyService implements ICRUDService
{

    /**
     * @param Currency $model
     * @return Currency
     * @throws \App\Exceptions\ModelExceptions\ModelCreateException
     */
    public function create($model): Currency
    {
        try {
            $model->save();

            return $model;
        } catch (\Exception $exception){
            throw new ModelCreateException(Currency::class);
        }
    }

    /**
     * @param Currency $model
     * @param $attributes
     * @return Currency
     * @throws ModelUpdateException|\App\Exceptions\ModelExceptions\ModelReadException
     */
    public function update($model, $attributes): Currency
    {
        if ($model) {
            try {
                $model->update($attributes);

                return $model;
            } catch (\Exception $exception){
                throw new ModelUpdateException(Currency::class);
            }
        }
        else{
            throw new ModelReadException(Currency::class);
        }
    }

    /**
     * @param array $filter
     * @return Builder
     * @throws \App\Exceptions\ModelExceptions\ModelReadException|\App\Exceptions\ModelExceptions\ModelFilterException
     */
    public function find($filter) : Builder
    {
        return Currency::filter($filter);
    }

    /**
     * @param Currency $model
     * @return void
     * @throws ModelDeleteException
     */
    public function delete($model)
    {
        try {
            $model->delete();
        } catch (\Exception $exception){
            throw new ModelDeleteException(Currency::class);
        }
    }
}
