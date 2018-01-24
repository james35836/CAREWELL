<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTblCoveragePlanTable412pmjan2418 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_coverage_plan', function (Blueprint $table) {
            $table->renameColumn('coverage_price', 'coverage_monthly_premium');
            $table->string('coverage_age_bracket')->after('coverage_name');
            $table->string('coverage_case_handling')->after('coverage_name');
            $table->string('coverage_maximum_benefit')->after('coverage_name');
            $table->string('coverage_patient_confinement')->after('coverage_name');
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
