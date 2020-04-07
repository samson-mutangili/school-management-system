<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FeeTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBiginteger('student_id');            
            $table->string('branch');
            $table->string('transaction_no');
            $table->string('date_paid');
            $table->double('amount', 2);
            $table->string('date_recorded');
            $table->unsignedBiginteger('emp_id');
            $table->timestamps();

            $table->foreign('student_id')
                  ->references('id')->on('students')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('emp_id')
                  ->references('id')->on('non_teaching_staff')
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
        Schema::dropIfExists('fee_transactions');
    }
}
