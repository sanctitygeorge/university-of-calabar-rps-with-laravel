<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEng010Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eng_010', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lastName');
            $table->string('otherNames');
            $table->string('regNo')->unique();
            $table->string('gender');
            $table->string('state');
            $table->integer('assessment');
            $table->integer('exam');
            $table->integer('total');
            $table->string('grade');
            $table->integer('point');
            
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
        Schema::dropIfExists('eng_010');
    }
}
