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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('const');
            $table->timestamps();
        });

        \App\Models\Role::create([
            'title' => 'Клиент',
            'const' => 'CLIENT'
        ]);

        \App\Models\Role::create([
            'title' => 'Модератор',
            'const' => 'MODERATOR'
        ]);

        \App\Models\Role::create([
            'title' => 'Администратор',
            'const' => 'ADMIN'
        ]);

        Schema::table('users', function (Blueprint $table) {
            $table->integer('role_id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role_id');
        });
    }
};
