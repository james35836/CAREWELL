<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblApprovalTotal850pmapr252018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_approval_total', function (Blueprint $table) 
        {
            $table->increments('approval_total_id');
            $table->string('total_gross_amount');
            $table->string('total_philhealth');
            $table->string('total_charge_patient');
            $table->string('total_charge_carewell');
            $table->string('total_type');
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
