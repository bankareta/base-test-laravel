<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_users', function (Blueprint $table) {
            $table->increments('id');
            $table->text('fullname')->nullable();
            $table->string('username')->unique();
            $table->text('address')->nullable();
            $table->text('gender')->nullable();
            $table->text('fotopath')->nullable();
            $table->text('signaturepath')->nullable();
            $table->date('birthdate')->nullable();
            $table->datetime('last_activity')->nullable();
            $table->text('position')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('token')->default('');
            $table->datetime('last_login');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_users');
    }
}
