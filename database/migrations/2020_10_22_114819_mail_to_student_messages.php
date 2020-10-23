<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MailToStudentMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MailToStudentMessages', function (Blueprint $table) {
            $table->bigIncrements('message_id');            
            $table->unsignedBigInteger('student_id');            
            $table->unsignedBigInteger('from_teacher_id');
            $table->unsignedBigInteger('to_parent_id');
            $table->string('subject');
            $table->longtext('message_body');
            $table->string('date_send');
            $table->timestamps();
            $table->foreign('student_id')
                  ->references('id')->on('students')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('from_teacher_id')
                  ->references('id')->on('teachers')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('to_parent_id')
                  ->references('id')->on('parents')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('MailToStudentMessages');
    }
}
