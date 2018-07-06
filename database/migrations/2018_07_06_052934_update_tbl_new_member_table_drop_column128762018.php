<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTblNewMemberTableDropColumn128762018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_new_member', function (Blueprint $table) 
        {
            $table->dropColumn('cal_payment_end');
            $table->dropColumn('cal_payment_start');
            $table->dropColumn('cal_payment_date');
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
