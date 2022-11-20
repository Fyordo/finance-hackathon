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
use App\Models\Searchable;
use App\Models\User;
use App\Models\RoleRight;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class UserService implements ICRUDService
{
    /**
     * @param User $model
     * @return User
     * @throws \App\Exceptions\ModelExceptions\ModelCreateException
     */
    public function create($model): User
    {
        if (!Auth::check() || !RoleRightManager::haveAccess(Auth::user()->role, User::class, RoleRight::CREATE_RIGHT)){
            throw new RightException(RoleRight::CREATE_RIGHT);
        }
        try {
            $model->save();

            return $model;
        } catch (\Exception $exception){
            throw new ModelCreateException(User::class);
        }
    }

    /**
     * @param User $model
     * @param $attributes
     * @return User
     * @throws ModelUpdateException|\App\Exceptions\ModelExceptions\ModelReadException
     */
    public function update($model, $attributes): User
    {
        if (!Auth::check() || !RoleRightManager::haveAccess(Auth::user()->role, User::class, RoleRight::UPDATE_RIGHT)){
            throw new RightException(RoleRight::UPDATE_RIGHT);
        }
        if ($model) {
            if (isset($attributes['blocked']) && !in_array(Auth::user()->role->const, [Role::ADMIN_ROLE, Role::MODERATOR_ROLE])){
                throw new RightException(RoleRight::UPDATE_RIGHT);
            }
            try {
                $model->update($attributes);

                return $model;
            } catch (\Exception $exception){
                throw new ModelUpdateException(User::class);
            }
        }
        else{
            throw new ModelReadException(User::class);
        }
    }

    /**
     * @param array $filter
     * @param ?User $user
     * @return Collection
     * @throws Builder
     */
    public function find($filter) : Builder
    {
        if (!Auth::check() || !RoleRightManager::haveAccess(Auth::user()->role, User::class, RoleRight::READ_RIGHT)){
            throw new RightException(RoleRight::READ_RIGHT);
        }

        return User::filter($filter);
    }

    /**
     * @param User $model
     * @return void
     * @throws ModelDeleteException
     */
    public function delete($model)
    {
        if (!Auth::check() || !RoleRightManager::haveAccess(Auth::user()->role, User::class, RoleRight::DELETE_RIGHT)){
            throw new RightException(RoleRight::DELETE_RIGHT);
        }
        try {
            $model->delete();
        } catch (\Exception $exception){
            throw new ModelDeleteException(User::class);
        }
    }
}
