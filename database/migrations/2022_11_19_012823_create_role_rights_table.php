<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_rights', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id');
            $table->string('model');
            $table->boolean('create')->default(false);
            $table->boolean('read')->default(false);
            $table->boolean('update')->default(false);
            $table->boolean('delete')->default(false);
            $table->timestamps();
        });

        $adminRoleId = \App\Facades\RoleManager::find(['const' => \App\Models\Role::ADMIN_ROLE])->first()->id;
        $moderatorRoleId = \App\Facades\RoleManager::find(['const' => \App\Models\Role::MODERATOR_ROLE])->first()->id;
        $clientRoleId = \App\Facades\RoleManager::find(['const' => \App\Models\Role::CLIENT_ROLE])->first()->id;

        \App\Models\RoleRight::create([
            'role_id' => $adminRoleId,
            'model' => \App\Models\RoleRight::class,
            'create' => true,
            'read' => true,
            'update' => true,
            'delete' => true,
        ]);
        \App\Models\RoleRight::create([
            'role_id' => $adminRoleId,
            'model' => \App\Models\Role::class,
            'create' => true,
            'read' => true,
            'update' => true,
            'delete' => true,
        ]);
        \App\Models\RoleRight::create([
            'role_id' => $adminRoleId,
            'model' => \App\Models\User::class,
            'create' => true,
            'read' => true,
            'update' => true,
            'delete' => true,
        ]);

        \App\Models\RoleRight::create([
            'role_id' => $moderatorRoleId,
            'model' => \App\Models\User::class,
            'create' => true,
            'read' => true,
            'update' => true,
            'delete' => true,
        ]);

        \App\Models\RoleRight::create([
            'role_id' => $clientRoleId,
            'model' => \App\Models\User::class,
            'create' => true,
            'read' => true,
            'update' => true,
            'delete' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_rights');
    }
};
