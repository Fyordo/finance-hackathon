<?php

use App\Facades\RoleManager;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $user = User::create([
        'role_id' => Role::where('const', '=', Role::ADMIN_ROLE)->first()->id,
        'password' => '123',
        'email' => 'test@test',
        'name' => 'TEST'
    ]);
    $clientRole = RoleManager::find(['const' => Role::CLIENT_ROLE], $user);
    $moderatorRole = RoleManager::find(['const' => Role::MODERATOR_ROLE], $user);
    $adminRole = RoleManager::find(['const' => Role::ADMIN_ROLE], $user);
    dd($user);
    return view('welcome');
});
