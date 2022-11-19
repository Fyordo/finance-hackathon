<?php

namespace App\Http\Resources;

use App\Facades\CurrencyManager;
use App\Facades\UserManager;
use App\Models\Currency;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'currency' => $this->when($this->currency_id, new CurrencyResource(CurrencyManager::find(['id' => $this->currency_id])->first())),
            'amount' => $this->amount,
            'user' => $this->when($this->user_id, new UserResource(UserManager::find(['id' => $this->user_id])->first())),
        ];
    }
}
