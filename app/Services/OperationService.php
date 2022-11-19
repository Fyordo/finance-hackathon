<?php

namespace App\Services;

use App\Exceptions\ModelExceptions\ModelCreateException;
use App\Exceptions\ModelExceptions\ModelDeleteException;
use App\Exceptions\ModelExceptions\ModelReadException;
use App\Exceptions\ModelExceptions\ModelUpdateException;
use App\Exceptions\OperationExceptions\InvalidCodeException;
use App\Exceptions\OperationExceptions\InvalidPriceException;
use App\Exceptions\OperationExceptions\InvalidSumException;
use App\Exceptions\RightException;
use App\Facades\AccountManager;
use App\Models\Operation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OperationService implements ICRUDService
{
    /**
     * @param Operation $model
     * @return Operation
     * @throws \App\Exceptions\ModelExceptions\ModelCreateException
     */
    public function create($model): Operation
    {
        $accountFrom = AccountManager::find(['id' => $model->account_from_id])->first();
        if ($model->sum && ($model->sum < 0 || floatval($accountFrom->amount) < $model->sum)){
            throw new InvalidSumException();
        }
        if ($model->price && !$this->checkPrice($model->price)){
            throw new InvalidPriceException();
            }
        try {
            $model->confirmation_code = $this->genRandomCode();
            $model->save();

            if (Auth::user()->dfa && Auth::user()->email){
                \Illuminate\Support\Facades\Mail::to(Auth::user()->email)->send(new \App\Mail\ConfirmationMail($model->confirmation_code));
            }

            return $model;
        } catch (\Exception $exception){
            throw new ModelCreateException(Operation::class);
        }
    }

    /**
     * @param Operation $model
     * @param $attributes
     * @return Operation
     * @throws ModelUpdateException|\App\Exceptions\ModelExceptions\ModelReadException
     */
    public function update($model, $attributes): Operation
    {
        if ($model->created_user_id !== Auth::id()){
            throw new RightException('update');
        }
        if ($model) {
            if (isset($attributes['sum']) && $attributes['sum'] < 0){
                throw new InvalidSumException();
            }
            if (isset($attributes['price']) && !$this->checkPrice($attributes['price'])){
                throw new InvalidPriceException();
            }
            try {
                $model->update($attributes);

                return $model;
            } catch (\Exception $exception){
                throw new ModelUpdateException(Operation::class);
            }
        }
        else{
            throw new ModelReadException(Operation::class);
        }
    }

    /**
     * @param array $filter
     * @return Builder
     * @throws \App\Exceptions\ModelExceptions\ModelReadException|\App\Exceptions\ModelExceptions\ModelFilterException
     */
    public function find($filter) : Builder
    {
        return Operation::forUser(Auth::user())->filter($filter);
    }

    /**
     * @param Operation $model
     * @return void
     * @throws ModelDeleteException
     */
    public function delete($model)
    {
        if ($model->created_user_id !== Auth::id()){
            throw new RightException('delete');
        }
        try {
            $model->delete();
        } catch (\Exception $exception){
            throw new ModelDeleteException(Operation::class);
        }
    }

    public function confirm(Operation $operation, string $code){
        try {
            if ($operation->confirmed_at !== null){
                return [
                    'status' => 'already confirmed',
                    'account_from' => $operation->accountFrom,
                    'account_to' => $operation->accountTo,
                ];
            }
            if ($operation->confirmation_code !== $code){
                throw new InvalidCodeException();
            }
            DB::beginTransaction();
            $operation->accountFrom()->update([
                'amount' => $operation->accountFrom->amount - $operation->sum
            ]);
            $operation->accountTo()->update([
                'amount' => $operation->accountTo->amount + (($operation->sum) * $operation->price)
            ]);

            $operation->confirmed_at = new \DateTime();
            DB::commit();
            return [
                'status' => 'confirmed',
                'account_from' => $operation->accountFrom,
                'account_to' => $operation->accountTo,
            ];
        } catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * Проверка валидности курса
     *
     * @param float $price
     * @return bool
     */
    private function checkPrice(float $price) : bool{
        $price = floatval($price);

        if ($price <= 0){
            return false;
        }

        // TODO Взять с апишки данные о курсе и сравнить с пейлоадом

        return true;
    }

    /**
     * Сгенерировать случайный код для подтверждения перевода
     *
     * @return string
     */
    private function genRandomCode(){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
