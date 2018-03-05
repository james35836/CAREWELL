<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblApprovalDiagnosis320mar42018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_approval_diagnosis', function (Blueprint $table) {
            $table->increments('approval_diagnosis_id');
            $table->integer('approval_diagnosis_type');
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
