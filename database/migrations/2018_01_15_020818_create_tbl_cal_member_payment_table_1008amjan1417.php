<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCalMemberPaymentTable1008amjan1417 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_company_cal_member', function (Blueprint $table) {
            $table->increments('cal_member_id');
            $table->string('cal_member_amount');
            $table->string('cal_member_date_paid');
            $table->integer('member_id');
            $table->integer('cal_id');
            
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
