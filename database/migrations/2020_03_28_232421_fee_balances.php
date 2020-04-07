<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FeeBalances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_balances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBiginteger('student_id');            
            $table->double('total_fees', 2);
            $table->double('amount_paid', 2);
            $table->double('balance', 2);
            $table->double('overpay', 2)->default(0);
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
        Schema::dropIfExists('fee_balances');
    }
}
