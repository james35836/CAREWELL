<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCoveragePlanProcedureTable1157amfeb92018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_coverage_plan_procedure', function (Blueprint $table) {
            $table->increments('coverage_plan_procedure_id');
            $table->integer('procedure_id');
            $table->integer('coverage_plan_tag_id');
            $table->integer('availment_charges_id');
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
