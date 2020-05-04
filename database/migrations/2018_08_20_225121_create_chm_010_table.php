<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChm010Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chm_010', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lastName');
            $table->string('otherNames');
            $table->string('regNo')->unique();
            $table->string('gender');
            $table->string('state');
            // $table->string('courseCode');
            // $table->string('courseTitle');
            $table->integer('assessment');
            $table->integer('exam');
            $table->integer('total');
            $table->string('grade');
            $table->integer('point');
            // $table->integer('studentID')->unsigned();
            // $table->foreign('studentID')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
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
        Schema::dropIfExists('chm_010');
    }
}
