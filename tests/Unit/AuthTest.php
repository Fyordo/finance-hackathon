<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function testRegister(){
        $payload = [
            'email' => 'test@mail.ru',
            'phone' => '12345678900',
            'name' => 'TEST',
            'password' => '123123'
        ];

        $response = $this->json('post', 'api/auth/register', $payload)->decodeResponseJson();

        $this->assertEquals($response['status'], 'success');
        $this->assertNotNull(Auth::user());
    }

    public function testLogin(){
        $user = $this->createClientUser();

        $payload = [];

        $payload['email'] = $user->email;
        $payload['password'] = '123123';

        $response = $this->json('post', 'api/auth/login', $payload)->decodeResponseJson();

        $this->assertEquals($response['status'], 'success');
        $this->assertNotNull(Auth::user());
    }

    public function testLogout(){
        $user = $this->createClientUser();

        $token = Auth::login($user);

        $response = $this->json('post', 'api/auth/logout', [], ['Authorization' => 'Bearer ' . $token])->decodeResponseJson();

        $this->assertEquals($response['status'], 'success');
        $this->assertNull(Auth::user());
    }
}
