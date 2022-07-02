<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('first_name', 255)->nullable();
                $table->string('last_name', 255)->nullable();
                $table->string('email');
                $table->string('phone', 255)->nullable();
                $table->datetime('email_verified_at')->nullable();
                $table->string('password');
                $table->string('remember_token')->nullable();
                $table->string('profile_photo', 255)->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }
}
