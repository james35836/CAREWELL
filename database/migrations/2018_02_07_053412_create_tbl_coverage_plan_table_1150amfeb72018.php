<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCoveragePlanTable1150amfeb72018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_coverage_plan', function (Blueprint $table) {
            $table->increments('coverage_plan_id');
            $table->string('coverage_plan_name');
            $table->string('coverage_plan_confinement');
            $table->string('coverage_plan_maximum_benefit');
            $table->string('coverage_plan_case_handling');
            $table->string('coverage_plan_age_bracket');
            $table->string('coverage_plan_monthly_premium');
            $table->string('coverage_plan_created');
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
