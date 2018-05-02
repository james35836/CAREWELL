<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTblNewCalMemberTable1058ammay22018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_new_cal_member', function (Blueprint $table) {
           $table->dropColumn('cal_payment_amount');
           $table->dropColumn('cal_payment_date');
           $table->dropColumn('cal_payment_count');
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
