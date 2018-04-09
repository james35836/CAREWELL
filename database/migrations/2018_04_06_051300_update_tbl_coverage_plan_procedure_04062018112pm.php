<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTblCoveragePlanProcedure04062018112pm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_coverage_plan_procedure', function (Blueprint $table) {
            $table->dropColumn('coverage_plan_tag_id');
            $table->dropColumn('availment_charges_id');
            $table->integer('availment_id');
            $table->string('plan_charges');
            $table->string('plan_covered_amount');
            $table->string('plan_limit');
            $table->integer('coverage_plan_id');
            
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
