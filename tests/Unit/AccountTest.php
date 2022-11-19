<?php

namespace Tests\Unit;

use App\Exceptions\RightException;
use App\Facades\AccountManager;
use App\Facades\CurrencyManager;
use App\Facades\RoleManager;
use App\Models\Account;
use App\Models\Currency;
use App\Models\Role;
use Tests\TestCase;

class AccountTest extends TestCase
{
    public function testWrite(){
        $user = $this->createAdminUser();
        $this->actingAs($user);
        $currency = CurrencyManager::create(new Currency(['title' => 'TITLE', 'const' => 'CONST', 'icon' => 'ICON']));
        $account = AccountManager::create(new Account(['currency_id' => $currency->id]));
        $this->assertEquals(0, $account->amount);
        $this->assertEquals($user->id, $account->user_id);
    }

    public function testRead(){
        $user = $this->createAdminUser();
        $this->actingAs($user);
        $currency = CurrencyManager::create(new Currency(['title' => 'TITLE', 'const' => 'CONST', 'icon' => 'ICON']));
        $account = AccountManager::create(new Account(['currency_id' => $currency->id]));
        $this->assertEquals(AccountManager::find(['user_id' => $user->id])->first()->amount, AccountManager::find(['id' => $account->id])->first()->amount);
    }

    public function testUpdate(){
        $user = $this->createAdminUser();
        $this->actingAs($user);
        $currency = CurrencyManager::create(new Currency(['title' => 'TITLE', 'const' => 'CONST', 'icon' => 'ICON']));
        $account = AccountManager::create(new Account(['currency_id' => $currency->id]));
        $this->assertEquals(1000, AccountManager::update($account, ['amount' => 1000])->amount);
        $this->assertEquals(0, AccountManager::update($account, ['amount' => -1000])->amount);

        $user = $this->createClientUser();
        $this->actingAs($user)->expectException(RightException::class);
        AccountManager::update($account, ['amount' => 1000]);
    }

    public function testDelete(){
        $user = $this->createAdminUser();
        $this->actingAs($user);
        $currency = CurrencyManager::create(new Currency(['title' => 'TITLE', 'const' => 'CONST', 'icon' => 'ICON']));
        $account = AccountManager::create(new Account(['currency_id' => $currency->id]));
        $this->assertNull(AccountManager::delete($account));

        $currency = CurrencyManager::create(new Currency(['title' => 'TITLE', 'const' => 'CONST', 'icon' => 'ICON']));
        $account = AccountManager::create(new Account(['currency_id' => $currency->id]));
        $user = $this->createClientUser();
        $this->actingAs($user)->expectException(RightException::class);
        AccountManager::delete($account);
    }
}
