<?php

namespace App\Services;

use App\Exceptions\ModelExceptions\ModelCreateException;
use App\Exceptions\ModelExceptions\ModelDeleteException;
use App\Exceptions\ModelExceptions\ModelFilterException;
use App\Exceptions\ModelExceptions\ModelReadException;
use App\Exceptions\ModelExceptions\ModelUpdateException;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;

class RoleService implements ICRUDService
{
    /**
     * @param Role $model
     * @return Role
     * @throws \App\Exceptions\ModelExceptions\ModelCreateException
     */
    public function create($model): Role
    {
        try {
            $model->save();

            return $model;
        } catch (\Exception $exception){
            throw new ModelCreateException(Role::class);
        }
    }

    /**
     * @param Role $model
     * @param $attributes
     * @return Role
     * @throws ModelUpdateException|\App\Exceptions\ModelExceptions\ModelReadException
     */
    public function update($model, $attributes): Role
    {
        if ($model) {
            try {
                $model->update($attributes);

                return $model;
            } catch (\Exception $exception){
                throw new ModelUpdateException(Role::class);
            }
        }
        else{
            throw new ModelReadException(Role::class);
        }
    }

    /**
     * @param array $filter
     * @return Collection
     * @throws \App\Exceptions\ModelExceptions\ModelReadException|\App\Exceptions\ModelExceptions\ModelFilterException
     */
    public function find($filter) : Collection
    {
        try {
            return Role::where($filter)->get();
        }
        catch (QueryException $queryException){
            throw new ModelFilterException();
        }
        catch (\Exception $exception){
            throw new ModelReadException(Role::class);
        }
    }

    /**
     * @param Role $model
     * @return void
     * @throws ModelDeleteException
     */
    public function delete($model)
    {
        try {
            $model->delete();
        } catch (\Exception $exception){
            throw new ModelDeleteException(Role::class);
        }
    }
}
