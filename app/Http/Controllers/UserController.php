<?php

namespace App\Http\Controllers;

use App\Facades\UserManager;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function index()
    {
        return UserResource::collection(UserManager::find(request()->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user
     * @return UserResource|JsonResponse
     */
    public function show(int $user)
    {
        try {
            return new UserResource(UserManager::find(['id' => $user])->first());
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
     * @param int $user
     * @return UserResource|JsonResponse
     */
    public function update(UserRequest $request, $user)
    {
        try {
            $validated = $request->validated();

            $item = UserManager::update(User::find($user), $validated);

            return new UserResource($item);
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
     * @param  int  $user
     * @return JsonResponse
     */
    public function destroy($user)
    {
        try {
            UserManager::delete(User::find($user));

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
