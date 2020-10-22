<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Teachers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone_no');
            $table->integer('tsc_no')->unique();
            $table->integer('id_no');
            $table->string('password');
            $table->char('gender');
            $table->string('subject_1');
            $table->string('subject_2');
            $table->string('religion');
            $table->string('nationality');
            $table->date('date_hired');
            $table->string('status')->default('active');
            $table->mediumText('profile_pic')->nullable();
            $table->date('date_left')->nullable();
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
        Schema::dropIfExists('teachers');
    }
}
