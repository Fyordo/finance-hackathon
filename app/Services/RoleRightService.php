<?php

namespace App\Services;

use App\Exceptions\ModelExceptions\ModelCreateException;
use App\Exceptions\ModelExceptions\ModelDeleteException;
use App\Exceptions\ModelExceptions\ModelFilterException;
use App\Exceptions\ModelExceptions\ModelReadException;
use App\Exceptions\ModelExceptions\ModelUpdateException;
use App\Exceptions\RightException;
use App\Models\Role;
use App\Models\RoleRight;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class RoleRightService implements ICRUDService
{
    /**
     * @param RoleRight $model
     * @return RoleRight
     * @throws \App\Exceptions\ModelExceptions\ModelCreateException
     */
    public function create($model): RoleRight
    {
        if (!$this->haveAccess(Auth::user()->role, RoleRight::class, RoleRight::CREATE_RIGHT)){
            throw new RightException(RoleRight::CREATE_RIGHT);
        }
        try {
            $model->save();

            return $model;
        } catch (\Exception $exception){
            throw new ModelCreateException(RoleRight::class);
        }
    }

    /**
     * @param RoleRight $model
     * @param $attributes
     * @return RoleRight
     * @throws ModelUpdateException|\App\Exceptions\ModelExceptions\ModelReadException
     */
    public function update($model, $attributes): RoleRight
    {
        if (!$this->haveAccess(Auth::user()->role, RoleRight::class, RoleRight::UPDATE_RIGHT)){
            throw new RightException(RoleRight::UPDATE_RIGHT);
        }
        if ($model) {
            try {
                $model->update($attributes);

                return $model;
            } catch (\Exception $exception){
                throw new ModelUpdateException(RoleRight::class);
            }
        }
        else{
            throw new ModelReadException(RoleRight::class);
        }
    }

    /**
     * @param array $filter
     * @return Collection
     * @throws \App\Exceptions\ModelExceptions\ModelReadException|\App\Exceptions\ModelExceptions\ModelFilterException
     * @throws RightException
     */
    public function find($filter) : Collection
    {
        if (!$this->haveAccess(Auth::user()->role, RoleRight::class, RoleRight::READ_RIGHT)){
            throw new RightException(RoleRight::READ_RIGHT);
        }
        try {
            return RoleRight::where($filter)->get();
        }
        catch (QueryException $queryException){
            throw new ModelFilterException();
        }
        catch (\Exception $exception){
            throw new ModelReadException(RoleRight::class);
        }
    }

    /**
     * @param RoleRight $model
     * @return void
     * @throws ModelDeleteException
     */
    public function delete($model)
    {
        if (!$this->haveAccess(Auth::user()->role, RoleRight::class, RoleRight::DELETE_RIGHT)){
            throw new RightException(RoleRight::DELETE_RIGHT);
        }
        try {
            $model->delete();
        } catch (\Exception $exception){
            throw new ModelDeleteException(RoleRight::class);
        }
    }

    /**
     * @param Role $role
     * @param string $modelClass
     * @param string $type
     * @return mixed
     * @throws ModelFilterException
     * @throws ModelReadException
     */
    public function haveAccess(Role $role, string $modelClass, string $type){
        try {
            return RoleRight::where([
                'role_id' => $role->id,
                'model' => $modelClass,
            ])->first()->$type;
        }
        catch (QueryException $queryException){
            throw new ModelFilterException();
        }
        catch (\Exception $exception){
            return false;
        }

    }
}
