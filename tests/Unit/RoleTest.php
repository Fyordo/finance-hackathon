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
        $clientRole = RoleManager::find(['const' => Role::CLIENT_ROLE], $user);
        $moderatorRole = RoleManager::find(['const' => Role::MODERATOR_ROLE], $user);
        $adminRole = RoleManager::find(['const' => Role::ADMIN_ROLE], $user);

        $this->assertEquals(1, $clientRole->count());
        $this->assertEquals(1, $moderatorRole->count());
        $this->assertEquals(1, $adminRole->count());
    }

    public function testWrite(){
        $user = $this->createAdminUser();
        $this->assertEquals(RoleManager::create(new Role(['title' => 'TITLE', 'const' => 'CONST']), $user)->const, 'CONST');

        $this->expectException(RightException::class);
        $user = $this->createClientUser();
        RoleManager::create(new Role(['title' => 'TITLE', 'const' => 'CONST']), $user);
    }

    public function testUpdate(){
        $user = $this->createAdminUser();
        $role = RoleManager::create(new Role(['title' => 'TITLE', 'const' => 'CONST']), $user);
        $this->assertEquals(RoleManager::update($role, ['const' => 'CONST222'], $user)->const, 'CONST222');

        $this->expectException(RightException::class);
        $user = $this->createClientUser();
        RoleManager::update($role, ['const' => 'CONST333'], $user);
    }

    public function testDelete(){
        $user = $this->createAdminUser();
        $role = RoleManager::create(new Role(['title' => 'TITLE', 'const' => 'CONST']), $user);
        $this->assertNull(RoleManager::delete($role, $user));

        $this->expectException(RightException::class);
        $role = RoleManager::create(new Role(['title' => 'TITLE', 'const' => 'CONST']), $user);
        $user = $this->createClientUser();
        RoleManager::delete($role, $user);
    }
}
