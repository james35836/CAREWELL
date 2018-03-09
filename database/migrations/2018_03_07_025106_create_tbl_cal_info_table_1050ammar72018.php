<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCalInfoTable1050ammar72018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cal_info', function (Blueprint $table) {
            $table->increments('cal_info_id');
            $table->string('cal_info_attached_file');
            $table->string('cal_info_check_number');
            $table->string('cal_info_collection_date');
            $table->string('cal_info_check_date');
            $table->string('cal_info_or_number');
            $table->string('cal_info_amount');
            $table->string('cal_info_created');
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
