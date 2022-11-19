<?php

namespace App\Observers;

use App\Models\Operation;
use Illuminate\Support\Facades\Auth;

class OperationObserver
{
    public function saving(Operation $currency)
    {
        $currency->created_user_id = Auth::id();
        $currency->updated_user_id = Auth::id();
    }

    public function updating(Operation $currency){
        $currency->updated_user_id = Auth::id();
    }
}
