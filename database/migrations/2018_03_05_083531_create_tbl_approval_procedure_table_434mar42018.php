<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblApprovalProcedureTable434mar42018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_approval_procedure', function (Blueprint $table) {
            $table->increments('procedure_approval_id');
            $table->integer('procedure_id');
            $table->string('procedure_gross_amount');
            $table->string('procedure_philhealth');
            $table->string('procedure_charge_patient');
            $table->string('procedure_charge_carewell');
            $table->integer('diagnosis_id');
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
