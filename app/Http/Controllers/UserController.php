<?php

namespace App\Http\Controllers;

use App\Exceptions\ModelExceptions\ModelReadException;
use App\Facades\UserManager;
use App\Http\Requests\UserRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function index(SearchRequest $request)
    {
        $validated = $request->validated();

        $perPage = $validated['per_page'] ?? 2;
        $filter = $validated ?? [];

        return UserResource::collection(UserManager::find($filter)->paginate($perPage));
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
            $item = UserManager::find(['id' => $user])->first();
            if (!$item){
                throw new ModelReadException(User::class);
            }
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
