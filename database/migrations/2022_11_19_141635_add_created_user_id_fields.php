<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('created_user_id')->nullable();
            $table->bigInteger('updated_user_id')->nullable();
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->bigInteger('created_user_id')->nullable();
            $table->bigInteger('updated_user_id')->nullable();
        });

        Schema::table('role_rights', function (Blueprint $table) {
            $table->bigInteger('created_user_id')->nullable();
            $table->bigInteger('updated_user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('created_user_id');
            $table->dropColumn('updated_user_id');
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('created_user_id');
            $table->dropColumn('updated_user_id');
        });
        Schema::table('role_rights', function (Blueprint $table) {
            $table->dropColumn('created_user_id');
            $table->dropColumn('updated_user_id');
        });
    }
};
