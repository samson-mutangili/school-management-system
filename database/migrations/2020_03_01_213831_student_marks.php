<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudentMarks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_marks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->year('year');
            $table->integer('term');
            $table->string('exam_type');
            $table->unsignedBigInteger('student_id');
            $table->string('class_name');
            $table->string('subject');
            $table->integer('marks_obtained');
            $table->char('grade', 2);
            $table->string('comments');
            $table->unsignedBigInteger('teacher_id');
            $table->timestamps();

            $table->foreign('student_id')
                  ->references('id')->on('students')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('teacher_id')
                  ->references('id')->on('teachers')
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
        Schema::dropIfExists('student_marks');
    }
}
