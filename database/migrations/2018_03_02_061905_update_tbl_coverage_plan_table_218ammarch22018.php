<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTblCoveragePlanTable218ammarch22018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_coverage_plan', function ($table) {
            $table->string('coverage_plan_mbl_year')->after('coverage_plan_age_bracket');
            $table->string('coverage_plan_mbl_illness')->after('coverage_plan_age_bracket');
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
