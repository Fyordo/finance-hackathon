<?php

namespace App\Http\Controllers;

use App\Facades\RoleManager;
use App\Http\Requests\Role\RoleFilterRequest;
use App\Http\Requests\RoleRequest;
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
    public function index()
    {
        try {
            return RoleResource::collection(RoleManager::find(request()->all()));
        }
        catch (\Exception $exception){
            return response()->json([
                'error' => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RoleRequest  $request
     * @return \Illuminate\Http\JsonResponse|RoleResource
     */
    public function store(RoleRequest $request)
    {
        try {
            $validated = $request->validated();

            $item = RoleManager::create(new Role($validated));

            return new RoleResource($item);
        }
        catch (\Exception $exception){
            return response()->json([
                'error' => $exception->getMessage()
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
            return new RoleResource(RoleManager::find(['id' => $role])->first());
        }
        catch (\Exception $exception){
            return response()->json([
                'error' => $exception->getMessage(),
                'type' => $exception::class
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
    public function update(RoleRequest $request, $role)
    {
        try {
            $validated = $request->validated();

            $item = RoleManager::update(Role::find($role), $validated);

            return new RoleResource($item);
        }
        catch (\Exception $exception){
            return response()->json([
                'error' => $exception->getMessage(),
                'type' => $exception::class
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
                'type' => $exception::class
            ], 400);
        }
    }
}