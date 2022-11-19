<?php

namespace Tests;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;
    use DatabaseMigrations;

    public function createAdminUser() : User{
        return User::create([
            'role_id' => Role::where('const', '=', Role::ADMIN_ROLE)->first()->id,
            'password' => '123',
            'email' => 'admin@test',
            'name' => 'TEST'
        ]);
    }

    public function createModeratorUser() : User{
        return User::create([
            'role_id' => Role::where('const', '=', Role::MODERATOR_ROLE)->first()->id,
            'password' => '123',
            'email' => 'moderator@test',
            'name' => 'TEST'
        ]);
    }

    public function createClientUser() : User{
        return User::create([
            'role_id' => Role::where('const', '=', Role::CLIENT_ROLE)->first()->id,
            'password' => '123',
            'email' => 'client@test',
            'name' => 'TEST'
        ]);
    }
}
