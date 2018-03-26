<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnTblCalTable1148Mar21 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_cal', function ($table) {
           $table->dropColumn('cal_payment_count');
           $table->dropColumn('cal_coverage_month_start');
           $table->dropColumn('cal_coverage_month_end');
           $table->dropColumn('cal_coverage_period_start');
           $table->dropColumn('cal_coverage_period_end');
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
