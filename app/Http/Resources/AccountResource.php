<?php

namespace App\Http\Resources;

use App\Facades\CurrencyManager;
use App\Facades\UserManager;
use App\Models\Currency;
use App\Models\User;
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
            'currency' => $this->when($this->currency_id, new CurrencyResource(Currency::find($this->currency_id))),
            'amount' => $this->amount,
            'user' => $this->when($this->user_id, new UserResource(User::find($this->user_id))),
        ];
    }
}
