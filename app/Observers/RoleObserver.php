<?php

namespace App\Observers;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class RoleObserver
{
    public function saving(Role $role)
    {
        $role->created_user_id = Auth::id();
        $role->updated_user_id = Auth::id();
    }

    public function updating(Role $role){
        $role->updated_user_id = Auth::id();
    }
}
