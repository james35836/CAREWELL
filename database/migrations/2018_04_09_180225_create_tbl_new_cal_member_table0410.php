<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblNewCalMemberTable0410 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_new_cal_member', function (Blueprint $table) {
            $table->increments('cal_new_member_id');
            $table->string('cal_payment_amount');
            $table->string('cal_payment_date');
            $table->string('cal_payment_start');
            $table->string('cal_payment_end');
            $table->string('cal_payment_count');
            $table->integer('new_member_id');
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
