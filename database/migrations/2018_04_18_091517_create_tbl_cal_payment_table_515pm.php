<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCalPaymentTable515pm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cal_payment', function (Blueprint $table) 
        {
            $table->increments('cal_payment_id');
            $table->string('cal_payment_start');
            $table->string('cal_payment_end');
            $table->string('cal_payment_type');
            $table->integer('cal_member_id');
            $table->tinyInteger('archived')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
