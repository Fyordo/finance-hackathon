<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\Currency;
use Illuminate\Support\Facades\Auth;

class AccountObserver
{
    public function saving(Account $account)
    {
        $account->created_user_id = Auth::id();
        $account->updated_user_id = Auth::id();
    }

    public function updating(Account $account){
        $account->updated_user_id = Auth::id();
    }
}
