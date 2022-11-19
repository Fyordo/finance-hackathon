<?php

namespace App\Services;

use App\Exceptions\ModelExceptions\ModelCreateException;
use App\Exceptions\ModelExceptions\ModelDeleteException;
use App\Exceptions\ModelExceptions\ModelFilterException;
use App\Exceptions\ModelExceptions\ModelReadException;
use App\Exceptions\ModelExceptions\ModelUpdateException;
use App\Exceptions\RightException;
use App\Facades\RoleRightManager;
use App\Models\Role;
use App\Models\RoleRight;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class RoleService implements ICRUDService
{
    /**
     * @param Role $model
     * @return Role
     * @throws \App\Exceptions\ModelExceptions\ModelCreateException
     */
    public function create($model): Role
    {
        if (!Auth::check() || !RoleRightManager::haveAccess(Auth::user()->role, Role::class, RoleRight::CREATE_RIGHT)){
            throw new RightException(RoleRight::CREATE_RIGHT);
        }
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
        if (!Auth::check() || !RoleRightManager::haveAccess(Auth::user()->role, Role::class, RoleRight::UPDATE_RIGHT)){
            throw new RightException(RoleRight::UPDATE_RIGHT);
        }
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
     * @param ?User $user
     * @return Builder
     * @throws \App\Exceptions\ModelExceptions\ModelReadException|\App\Exceptions\ModelExceptions\ModelFilterException
     */
    public function find($filter) : Builder
    {
        if (!Auth::check() || !RoleRightManager::haveAccess(Auth::user()->role, Role::class, RoleRight::READ_RIGHT)){
            throw new RightException(RoleRight::READ_RIGHT);
        }
        return Role::filter($filter);
    }

    /**
     * @param Role $model
     * @return void
     * @throws ModelDeleteException
     */
    public function delete($model)
    {
        if (!Auth::check() || !RoleRightManager::haveAccess(Auth::user()->role, Role::class, RoleRight::DELETE_RIGHT)){
            throw new RightException(RoleRight::DELETE_RIGHT);
        }
        try {
            $model->delete();
        } catch (\Exception $exception){
            throw new ModelDeleteException(Role::class);
        }
    }
}
