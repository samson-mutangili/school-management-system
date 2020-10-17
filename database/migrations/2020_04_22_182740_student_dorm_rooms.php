<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudentDormRooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_dorm_rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('room_id');
            $table->string('date_from');
            $table->string('date_to')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
            $table->foreign('student_id')
                  ->references('id')->on('students')
                  ->ondelete('cascade')
                  ->onupdate('cascade');
            $table->foreign('room_id')
                  ->references('id')->on('dormitories_rooms')
                  ->ondelete('cascade')
                  ->onupdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_dorm_rooms');
    }
}
