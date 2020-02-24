<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NonTeachingStaff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('non_teaching_staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('phone_no');
            $table->string('email')->nullable();
            $table->integer('id_no');
            $table->string('emp_no');
            $table->string('category');
            $table->string('gender');
            $table->string('religion');
            $table->string('nationality');
            $table->integer('salary');
            $table->string('status')->default('active');
            $table->date('hired_date');
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
        Schema::dropIfExists('non_teaching_staff');
    }
}
