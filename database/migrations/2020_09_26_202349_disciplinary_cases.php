<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DisciplinaryCases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplinary_cases', function (Blueprint $table) {
            $table->bigIncrements('case_id');
            $table->unsignedBigInteger('student_id');
            $table->string('student_class');
            $table->unsignedBigInteger('teacher_id');
            $table->string('case_category');
            $table->text('case_description');
            $table->string('date_reported');
            $table->text('action_taked')->nullable();
            $table->string('date_action_taken')->nullable();
            $table->unsignedBigInteger('action_taken_by')->nullable();
            $table->string('case_status')->default('uncleared');
            $table->timestamps();
            $table->foreign('student_id')
                  ->references('id')->on('students')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('teacher_id')
                  ->references('id')->on('teachers')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('action_taken_by')
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
        Schema::dropIfExists('disciplinary_cases');
    }
}
