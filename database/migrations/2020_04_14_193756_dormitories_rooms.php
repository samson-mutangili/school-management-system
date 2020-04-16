<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DormitoriesRooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dormitories_rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dorm_id');
            $table->string('room_no');
            $table->integer('room_capacity');
            $table->string('room_status');
            $table->timestamps();
            $table->foreign('dorm_id')
                  ->references('id')->on('dormitories')
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
        Schema::dropIfExists('dormitories_rooms');
    }
}
