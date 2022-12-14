<?php

namespace App\Http\Controllers;

use App\Exceptions\ModelExceptions\ModelReadException;
use App\Facades\RoleManager;
use App\Http\Requests\Role\RoleEditRequest;
use App\Http\Requests\User\UserReadRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function index(UserReadRequest $request)
    {
        $validated = $request->validated();

        $perPage = $validated['per_page'] ?? 12;
        $filter = $validated ?? [];

        return RoleResource::collection(RoleManager::find($filter)->paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Role\RoleEditRequest  $request
     * @return \Illuminate\Http\JsonResponse|RoleResource
     */
    public function store(RoleEditRequest $request)
    {
        try {
            $validated = $request->validated();

            $item = RoleManager::create(new Role($validated));

            return new RoleResource($item);
        }
        catch (\Exception $exception){
            return response()->json([
                'error' => $exception->getMessage(),
                'trace' => $exception->getTrace(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $role
     * @return RoleResource|JsonResponse
     */
    public function show(int $role)
    {
        try {
            $item = RoleManager::find(['id' => $role])->first();
            if (!$item){
                throw new ModelReadException(Role::class);
            }
            return new RoleResource($item);
        }
        catch (\Exception $exception){
            return response()->json([
                'error' => $exception->getMessage(),
                'trace' => $exception->getTrace(),
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $role
     * @return RoleResource|JsonResponse
     */
    public function update(RoleEditRequest $request, $role)
    {
        try {
            $validated = $request->validated();

            $item = RoleManager::update(Role::find($role), $validated);

            return new RoleResource($item);
        }
        catch (\Exception $exception){
            return response()->json([
                'error' => $exception->getMessage(),
                'trace' => $exception->getTrace(),
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $role
     * @return JsonResponse
     */
    public function destroy($role)
    {
        try {
            RoleManager::delete(Role::find($role));

            return null;
        }
        catch (\Exception $exception){
            return response()->json([
                'error' => $exception->getMessage(),
                'trace' => $exception->getTrace(),
            ], 400);
        }
    }
}
