<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Students extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->integer('admission_number');
            $table->date('date_of_admission');
            $table->string('gender');
            $table->string('DOB');
            $table->string('birth_cert_no');
            $table->string('religion');
            $table->integer('kcpe_index_no');
            $table->string('residence');
            $table->string('class');
            $table->string('nationality');
            $table->integer('year_of_study');
            $table->string('status')->default('active');
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
        Schema::dropIfExists('students');
    }
}
