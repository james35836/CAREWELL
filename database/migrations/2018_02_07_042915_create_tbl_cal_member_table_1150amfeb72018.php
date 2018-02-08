<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCalMemberTable1150amfeb72018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cal_member', function (Blueprint $table) {
            $table->increments('cal_member_id');
            $table->string('cal_payment_amount');
            $table->string('cal_payment_date');
            $table->integer('member_id');
            $table->integer('cal_id');
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
