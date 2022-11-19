<?php

namespace App\Observers;

use App\Models\Currency;
use Illuminate\Support\Facades\Auth;

class CurrencyObserver
{
    public function saving(Currency $currency)
    {
        $currency->created_user_id = Auth::id();
        $currency->updated_user_id = Auth::id();
    }

    public function updating(Currency $currency){
        $currency->updated_user_id = Auth::id();
    }
}
