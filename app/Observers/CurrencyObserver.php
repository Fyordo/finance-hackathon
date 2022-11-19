<?php

namespace App\Observers;

use App\Models\Currency;
use Illuminate\Support\Facades\Auth;

class CurrencyObserver
{
    public function saving(Currency $role)
    {
        $role->created_user_id = Auth::id();
        $role->updated_user_id = Auth::id();
    }

    public function updating(Currency $role){
        $role->updated_user_id = Auth::id();
    }
}
