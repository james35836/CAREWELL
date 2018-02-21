<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblDoctorProcedureTable233pm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_doctor_procedure', function (Blueprint $table) {
            $table->increments('doctor_procedure_id');
            $table->string('doctor_procedure_code');
            $table->string('doctor_procedure_descriptive');
            $table->string('doctor_procedure_rvu');
            $table->string('doctor_procedure_case');
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
