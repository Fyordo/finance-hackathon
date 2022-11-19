<?php

namespace App\Http\Controllers;

use App\Exceptions\ModelExceptions\ModelReadException;
use App\Facades\AccountManager;
use App\Http\Requests\Account\AccountEditRequest;
use App\Http\Requests\Account\AccountReadRequest;
use App\Http\Resources\AccountResource;
use App\Models\Account;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(AccountReadRequest $request)
    {
        $validated = $request->validated();

        $perPage = $validated['per_page'] ?? 12;
        $filter = $validated ?? [];

        return AccountResource::collection(AccountManager::find($filter)->paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return AccountResource|JsonResponse
     */
    public function store(AccountEditRequest $request)
    {
        try {
            $validated = $request->validated();

            $item = AccountManager::create(new Account($validated));

            return new AccountResource($item);
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
     * @param  int  $account
     * @return AccountResource|JsonResponse
     */
    public function show($account)
    {
        try {
            $item = AccountManager::find(['id' => $account])->first();
            if (!$item){
                throw new ModelReadException(Account::class);
            }
            return new AccountResource($item);
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
     * @param  int  $account
     * @return AccountResource|JsonResponse
     */
    public function update(AccountEditRequest $request, $account)
    {
        try {
            $validated = $request->validated();

            $item = AccountManager::update(Account::find($account), $validated);

            return new AccountResource($item);
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
     * @param  int  $account
     * @return ?JsonResponse
     */
    public function destroy($account)
    {
        try {
            AccountManager::delete(Account::find($account));

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

