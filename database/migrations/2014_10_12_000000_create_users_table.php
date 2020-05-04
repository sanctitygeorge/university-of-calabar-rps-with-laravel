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
        Schema::create('users', function (Blueprint $table) { 
            // $table->engine="InnoDB";
            $table->increments('id');
            $table->string('otherNames');
            $table->string('lastName');
            $table->string('regNo')->unique();
            $table->string('gender');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('state');
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
