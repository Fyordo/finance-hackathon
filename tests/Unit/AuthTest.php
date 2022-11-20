<?php

namespace Tests\Unit;

use App\Facades\CurrencyManager;
use App\Models\Account;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function testRegister(){
        $payload = [
            'email' => 'test@mail.ru',
            'phone' => '12345678906',
            'name' => 'TEST',
            'is_male' => true,
            'dfa' => false,
            'password' => '123123'
        ];

        $this->actingAs($this->createAdminUser());
        CurrencyManager::create(new Currency(['title' => 'test', 'const' => 'RUB', 'icon' => 'icon']));

        $response = $this->json('post', 'api/auth/register', $payload)->decodeResponseJson();

        $this->assertEquals('success', $response['status']);
        $this->assertNotNull(Auth::user());
        $this->assertEquals(1, Auth::user()->accounts->count());
    }

    public function testLogin(){
        $user = $this->createClientUser();

        $payload = [];

        $payload['email'] = $user->email;
        $payload['password'] = '123123';

        $response = $this->json('post', 'api/auth/login', $payload)->decodeResponseJson();

        $this->assertEquals('success', $response['status']);
        $this->assertNotNull(Auth::user());
    }

    public function testLogout(){
        $user = $this->createClientUser();

        $token = Auth::login($user);

        $response = $this->json('post', 'api/auth/logout', [], ['Authorization' => 'Bearer ' . $token])->decodeResponseJson();

        $this->assertEquals('success', $response['status']);
        $this->assertNull(Auth::user());
    }
}
