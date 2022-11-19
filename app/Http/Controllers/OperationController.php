<?php

namespace App\Http\Controllers;

use App\Exceptions\ModelExceptions\ModelReadException;
use App\Facades\OperationManager;
use App\Http\Requests\Operation\OperationEditRequest;
use App\Http\Requests\Operation\OperationReadRequest;
use App\Http\Resources\OperationResource;
use App\Models\Operation;
use Illuminate\Http\JsonResponse;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(OperationReadRequest $request)
    {
        $validated = $request->validated();

        $perPage = $validated['per_page'] ?? 12;
        $filter = $validated ?? [];

        return OperationResource::collection(OperationManager::find($filter)->paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return OperationResource|JsonResponse
     */
    public function store(OperationEditRequest $request)
    {
        try {
            $validated = $request->validated();

            $item = OperationManager::create(new Operation($validated));

            return new OperationResource($item);
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
     * @param  int  $operation
     * @return OperationResource|JsonResponse
     */
    public function show($operation)
    {
        try {
            $item = OperationManager::find(['id' => $operation])->first();
            if (!$item){
                throw new ModelReadException(Operation::class);
            }
            return new OperationResource($item);
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
     * @param  int  $operation
     * @return OperationResource|JsonResponse
     */
    public function update(OperationEditRequest $request, $operation)
    {
        try {
            $validated = $request->validated();

            $item = OperationManager::update(Operation::find($operation), $validated);

            return new OperationResource($item);
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
     * @param  int  $operation
     * @return ?JsonResponse
     */
    public function destroy($operation)
    {
        try {
            OperationManager::delete(Operation::find($operation));

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
