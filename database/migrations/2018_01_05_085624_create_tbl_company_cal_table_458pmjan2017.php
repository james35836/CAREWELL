<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCompanyCalTable458pmjan2017 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_company_cal', function (Blueprint $table) {
            $table->increments('cal_id');
            $table->string('cal_number');
            $table->string('cal_reveneu_period_month');
            $table->string('cal_reveneu_period_year');
            $table->string('cal_reveneu_period');
            $table->string('cal_reveneu_period_count');
            $table->string('cal_company_period_start');
            $table->string('cal_company_period_end');
            $table->string('cal_payment_date');
            $table->integer('cal_company_id');
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
