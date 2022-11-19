<?php

namespace App\Services;

use App\Exceptions\ModelExceptions\ModelCreateException;
use App\Exceptions\ModelExceptions\ModelDeleteException;
use App\Exceptions\ModelExceptions\ModelReadException;
use App\Exceptions\ModelExceptions\ModelUpdateException;
use App\Exceptions\OperationExceptions\InvalidSumException;
use App\Exceptions\RightException;
use App\Models\Operation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class OperationService implements ICRUDService
{
    /**
     * @param Operation $model
     * @return Operation
     * @throws \App\Exceptions\ModelExceptions\ModelCreateException
     */
    public function create($model): Operation
    {
        try {
            if ($model->sum && $model->sum < 0){
                throw new InvalidSumException();
            }
            // TODO InvalidPriceException
            // TODO Mail Confirmation
            $model->save();

            return $model;
        } catch (\Exception $exception){
            throw new ModelCreateException(Operation::class);
        }
    }

    /**
     * @param Operation $model
     * @param $attributes
     * @return Operation
     * @throws ModelUpdateException|\App\Exceptions\ModelExceptions\ModelReadException
     */
    public function update($model, $attributes): Operation
    {
        if ($model->created_user_id !== Auth::id()){
            throw new RightException('update');
        }
        if ($model) {
            if ($attributes['sum'] && $attributes['sum'] < 0){
                throw new InvalidSumException();
            }
            // TODO InvalidPriceException
            try {
                $model->update($attributes);

                return $model;
            } catch (\Exception $exception){
                throw new ModelUpdateException(Operation::class);
            }
        }
        else{
            throw new ModelReadException(Operation::class);
        }
    }

    /**
     * @param array $filter
     * @return Builder
     * @throws \App\Exceptions\ModelExceptions\ModelReadException|\App\Exceptions\ModelExceptions\ModelFilterException
     */
    public function find($filter) : Builder
    {
        return Operation::forUser(Auth::user())->filter($filter);
    }

    /**
     * @param Operation $model
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
            throw new ModelDeleteException(Operation::class);
        }
    }
}