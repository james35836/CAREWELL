<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblApprovalAvailedTable1025amfeb2018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_approval_availed', function (Blueprint $table) {
            $table->increments('availed_id');
            $table->string('availed_phil_charity');
            $table->string('availed_charge_patient');
            $table->string('availed_charge_carewell');
            $table->text('availed_remarks');
            $table->integer('availment_id');
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
