<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTblNewMemberTable1044ammay22018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_new_member', function (Blueprint $table) {
           $table->string('cal_payment_amount')->after('member_payment_mode');
           $table->string('cal_payment_date')->after('member_payment_mode');
           $table->string('cal_payment_count')->after('member_payment_mode');
           $table->string('cal_payment_start')->after('member_payment_mode');
           $table->string('cal_payment_end')->after('member_payment_mode');
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
