<?php

namespace App\Http\Resources;

use App\Facades\AccountManager;
use Illuminate\Http\Resources\Json\JsonResource;

class OperationResource extends JsonResource
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
            'account_from' => $this->when($this->account_from_id, new AccountResource(AccountManager::find(['id' => $this->account_from_id])->first())),
            'account_to' => $this->when($this->account_to_id, new AccountResource(AccountManager::find(['id' => $this->account_to_id])->first())),
            'sum' => $this->sum,
            'price' => $this->price,
            'confirmed_at' => $this->confirmed_at,
        ];
    }
}
