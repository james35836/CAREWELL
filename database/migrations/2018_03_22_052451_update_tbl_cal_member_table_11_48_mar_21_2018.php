<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTblCalMemberTable1148Mar212018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_cal_member', function ($table) {
           $table->string('cal_payment_start')->after('cal_payment_date');
           $table->string('cal_payment_end')->after('cal_payment_date');
           $table->string('cal_payment_count')->after('cal_payment_date');
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
