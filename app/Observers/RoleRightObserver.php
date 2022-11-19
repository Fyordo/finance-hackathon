<?php

namespace App\Observers;

use App\Models\Role;
use App\Models\RoleRight;
use Illuminate\Support\Facades\Auth;

class RoleRightObserver
{
    public function saving(RoleRight $roleRight)
    {
        $roleRight->created_user_id = Auth::id();
        $roleRight->updated_user_id = Auth::id();
    }

    public function updating(RoleRight $roleRight){
        $roleRight->updated_user_id = Auth::id();
    }
}
