<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudentMarksRanking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_marks_ranking', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->year('year');
            $table->integer('term');
            $table->string('exam_type');
            $table->string('class_name');
            $table->unsignedBigInteger('student_id');
            $table->integer('english')->nullable();
            $table->integer('kiswahili')->nullable();
            $table->integer('mathematics')->nullable();
            $table->integer('chemistry')->nullable();
            $table->integer('physics')->nullable();
            $table->integer('biology')->nullable();
            $table->integer('business_studies')->nullable();
            $table->integer('geography')->nullable();
            $table->integer('cre')->nullable();
            $table->integer('agriculture')->nullable();
            $table->integer('history')->nullable();
            $table->integer('total')->nullable();
            $table->double('average_marks', 4, 2)->nullable();
            $table->string('average_grade')->nullable();
            $table->timestamps();

            $table->foreign('student_id')
                  ->references('id')->on('students')
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
        Schema::dropIfExists('student_marks_ranking');
    }
}
