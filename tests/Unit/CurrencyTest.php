<?php

namespace Tests\Unit;

use App\Exceptions\RightException;
use App\Facades\CurrencyManager;
use App\Facades\RoleManager;
use App\Models\Currency;
use App\Models\Role;
use Tests\TestCase;

class CurrencyTest extends TestCase
{
    public function testWrite(){
        $user = $this->createAdminUser();
        $this->actingAs($user)->assertEquals('CONST', CurrencyManager::create(new Currency(['title' => 'TITLE', 'const' => 'CONST', 'icon' => 'ICON']))->const);

        $user = $this->createClientUser();
        $this->actingAs($user)->expectException(RightException::class);
        CurrencyManager::create(new Currency(['title' => 'TITLE', 'const' => 'CONST', 'icon' => 'ICON']));
    }

    public function testRead(){
        $user = $this->createAdminUser();
        $this->actingAs($user);

        $currency = CurrencyManager::create(new Currency(['title' => 'TITLE', 'const' => 'CONST', 'icon' => 'ICON']));
        $this->assertEquals('CONST', $currency->const);

        $user = $this->createClientUser();
        $this->actingAs($user)->assertEquals('CONST', CurrencyManager::find(['const' => 'CONST'])->first()->const);
    }

    public function testUpdate(){
        $user = $this->createAdminUser();
        $this->actingAs($user);
        $currency = CurrencyManager::create(new Currency(['title' => 'TITLE', 'const' => 'CONST', 'icon' => 'ICON']));
        $this->assertEquals('CONST222', CurrencyManager::update($currency, ['const' => 'CONST222'])->const);

        $user = $this->createClientUser();
        $this->actingAs($user)->expectException(RightException::class);
        CurrencyManager::update($currency, ['const' => 'CONST333']);
    }

    public function testDelete(){
        $user = $this->createAdminUser();
        $this->actingAs($user);
        $currency = CurrencyManager::create(new Currency(['title' => 'TITLE', 'const' => 'CONST', 'icon' => 'ICON']));
        $this->assertNull(CurrencyManager::delete($currency));

        $this->actingAs($user);
        $currency = CurrencyManager::create(new Currency(['title' => 'TITLE', 'const' => 'CONST', 'icon' => 'ICON']));
        $user = $this->createClientUser();
        $this->actingAs($user)->expectException(RightException::class);
        CurrencyManager::delete($currency);
    }
}
