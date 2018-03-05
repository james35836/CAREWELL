<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTblCoveragePlanTable210ammarch22018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_coverage_plan', function ($table) {
            $table->renameColumn('coverage_plan_monthly_premium','coverage_plan_premium');
            $table->renameColumn('coverage_plan_confinement','coverage_plan_preexisting');
            $table->string('coverage_plan_annual_benefit')->after('coverage_plan_maximum_benefit');
            $table->string('coverage_plan_processing_fee')->after('coverage_plan_age_bracket');
            $table->string('coverage_plan_hib')->after('coverage_plan_age_bracket');
            $table->string('coverage_plan_cari_fee')->after('coverage_plan_age_bracket');
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
