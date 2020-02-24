<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SchoolDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('school_name');
            $table->string('contact no_1');
            $table->string('contact_no_2');
            $table->string('email');
            $table->string('website_link');
            $table->string('location');
            $table->integer('address_id');
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
        Schema::dropIfExists('school_details');
    }
}
