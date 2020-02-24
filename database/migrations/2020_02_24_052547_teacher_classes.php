<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TeacherClasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBiginteger('teacher_id')->unsigned();            
            $table->string('class_name');
            $table->string('subject');
            $table->timestamps();

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
        Schema::dropIfExists('teacher_classes');
    }
}
