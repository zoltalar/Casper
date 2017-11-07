<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_users', function (Blueprint $table) {
            $table->smallInteger('role_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->primary(['role_id', 'user_id']);

            $table->foreign('role_id', 'fk_roles_users_roles')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');

            $table->foreign('user_id', 'fk_roles_users_users')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_users');
    }
}