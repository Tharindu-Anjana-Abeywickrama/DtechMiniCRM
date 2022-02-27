<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Employee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('frist_name');
            $table->string('last_name');
            $table->unsignedBigInteger('company');
            $table->string('email')->nullable();;
            $table->integer('phone')->nullable();;
            $table->timestamps();

            $table->foreign('company')->references('id')->on('company');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee');
    }
}
