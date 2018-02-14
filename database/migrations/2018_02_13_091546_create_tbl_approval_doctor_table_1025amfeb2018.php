<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblApprovalDoctorTable1025amfeb2018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_approval_doctor', function (Blueprint $table) {
            $table->increments('approval_doctor_id');
            $table->string('approval_doctor_actual_pf');
            $table->string('approval_doctor_rate_rvs');
            $table->string('approval_doctor_phil_charity');
            $table->string('approval_doctor_charge_patient');
            $table->string('approval_doctor_charge_carewell');
            $table->integer('specialization_id');
            $table->integer('doctor_id');
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
