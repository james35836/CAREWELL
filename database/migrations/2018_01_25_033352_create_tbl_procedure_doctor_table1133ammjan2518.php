<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblProcedureDoctorTable1133ammjan2518 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_procedure_doctor', function (Blueprint $table) {
            $table->increments('procedure_doctor_id');
            $table->string('procedure_doctor_actual_pf_charges');
            $table->string('procedure_doctor_rate_r_vs');
            $table->string('procedure_doctor_philhealth_charity');
            $table->string('procedure_doctor_charge_to_patient');
            $table->string('procedure_doctor_disapproved');
            $table->string('procedure_doctor_charge_to_carewell');
            $table->integer('procedure_id');
            $table->integer('doctor_id');
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
