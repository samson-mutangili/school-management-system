<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExamSession extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_sessions', function (Blueprint $table) {
            $table->bigIncrements('exam_id');
            $table->unsignedBigInteger('term_id');
            $table->string('exam_type');
            $table->date('exam_start_date');
            $table->date('exam_end_date');
            $table->string('exam_status');
            $table->timestamps();
            $table->foreign('term_id')
                  ->references('term_id')->on('term_sessions')
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
        Schema::dropIfExists('exam_sessions');
    }
}
