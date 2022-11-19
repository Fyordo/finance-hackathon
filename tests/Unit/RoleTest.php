<?php

namespace Tests\Unit;

use App\Exceptions\RightException;
use App\Facades\RoleManager;
use App\Models\Role;
use Tests\TestCase;

class RoleTest extends TestCase
{
    public function testRead(){
        $user = $this->createAdminUser();

        $this->actingAs($user)->assertEquals(1, RoleManager::find(['const' => Role::CLIENT_ROLE])->count());
        $this->actingAs($user)->assertEquals(1, RoleManager::find(['const' => Role::MODERATOR_ROLE])->count());
        $this->actingAs($user)->assertEquals(1, RoleManager::find(['const' => Role::ADMIN_ROLE])->count());
    }

    public function testWrite(){
        $user = $this->createAdminUser();
        $this->actingAs($user)->assertEquals('CONST', RoleManager::create(new Role(['title' => 'TITLE', 'const' => 'CONST']))->const);

        $user = $this->createClientUser();
        $this->actingAs($user)->expectException(RightException::class);
        RoleManager::create(new Role(['title' => 'TITLE', 'const' => 'CONST']));
    }

    public function testUpdate(){
        $user = $this->createAdminUser();
        $this->actingAs($user);
        $role = RoleManager::create(new Role(['title' => 'TITLE', 'const' => 'CONST']));
        $this->actingAs($user)->assertEquals('CONST222', RoleManager::update($role, ['const' => 'CONST222'])->const);

        $user = $this->createClientUser();
        $this->actingAs($user)->expectException(RightException::class);
        RoleManager::update($role, ['const' => 'CONST333']);
    }

    public function testDelete(){
        $user = $this->createAdminUser();
        $this->actingAs($user);
        $role = RoleManager::create(new Role(['title' => 'TITLE', 'const' => 'CONST']));
        $this->actingAs($user)->assertNull(RoleManager::delete($role));


        $user = $this->createClientUser();
        $this->actingAs($user)->expectException(RightException::class);
        $role = RoleManager::create(new Role(['title' => 'TITLE', 'const' => 'CONST']));
        RoleManager::delete($role);
    }
}
