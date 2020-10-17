<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudentClasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_classes', function (Blueprint $table) {
            $table->bigIncrements('class_id');
            $table->unsignedBigInteger('student_id');
            $table->string('year');
            $table->string('class_name');
            $table->text('stream');
            $table->integer('trial');
            $table->string('status');
            $table->timestamps();
            $table->foreign('student_id')
                  ->references('id')->on('students')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_classes');
    }
}
