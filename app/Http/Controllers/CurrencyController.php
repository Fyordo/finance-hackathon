<?php

namespace App\Http\Controllers;

use App\Exceptions\ModelExceptions\ModelReadException;
use App\Facades\CurrencyManager;
use App\Http\Requests\Currency\CurrencyEditRequest;
use App\Http\Requests\Currency\CurrencyReadRequest;
use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(CurrencyReadRequest $request)
    {
        $validated = $request->validated();

        $perPage = $validated['per_page'] ?? 12;
        $filter = $validated ?? [];

        return CurrencyResource::collection(CurrencyManager::find($filter)->get()/*->paginate($perPage)*/);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return CurrencyResource|JsonResponse
     */
    public function store(CurrencyEditRequest $request)
    {
        try {
            $validated = $request->validated();

            $item = CurrencyManager::create(new Currency($validated));

            return new CurrencyResource($item);
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
     * @param  int  $currency
     * @return CurrencyResource|JsonResponse
     */
    public function show($currency)
    {
        try {
            $item = CurrencyManager::find(['id' => $currency])->first();
            if (!$item){
                throw new ModelReadException(Currency::class);
            }
            return new CurrencyResource($item);
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
     * @param  int  $currency
     * @return CurrencyResource|JsonResponse
     */
    public function update(CurrencyEditRequest $request, $currency)
    {
        try {
            $validated = $request->validated();

            $item = CurrencyManager::update(Currency::find($currency), $validated);

            return new CurrencyResource($item);
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
     * @param  int  $currency
     * @return ?JsonResponse
     */
    public function destroy($currency)
    {
        try {
            CurrencyManager::delete(Currency::find($currency));

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
