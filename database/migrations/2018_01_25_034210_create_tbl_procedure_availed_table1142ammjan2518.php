<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblProcedureAvailedTable1142ammjan2518 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_procedure_availed', function (Blueprint $table) {
            $table->increments('procedure_availed_id');
            $table->string('procedure_availed_amount');
            $table->string('procedure_availed_remarks');
            $table->string('procedure_availed_philhealth_charity');
            $table->string('procedure_availed_charge_to_patient');
            $table->string('procedure_availed_disapproved');
            $table->string('procedure_availed_charge_to_carewell');
            $table->integer('procedure_id');
            $table->integer('approval_id');
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
