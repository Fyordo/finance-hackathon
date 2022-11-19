<?php

namespace Tests;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    public function createAdminUser() : User{
        return User::create([
            'role_id' => Role::where('const', '=', Role::ADMIN_ROLE)->first()->id,
            'password' => Hash::make('123123'),
            'phone' => '12345678900',
            'email' => 'admin@test.com',
            'name' => 'TEST'
        ]);
    }

    public function createModeratorUser() : User{
        return User::create([
            'role_id' => Role::where('const', '=', Role::MODERATOR_ROLE)->first()->id,
            'password' => Hash::make('123123'),
            'phone' => '12345678901',
            'email' => 'moderator@test.com',
            'name' => 'TEST'
        ]);
    }

    public function createClientUser() : User{
        return User::create([
            'role_id' => Role::where('const', '=', Role::CLIENT_ROLE)->first()->id,
            'password' => Hash::make('123123'),
            'phone' => '12345678902',
            'email' => 'client@test.com',
            'name' => 'TEST'
        ]);
    }
}
