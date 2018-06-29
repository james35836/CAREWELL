<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPayablePayeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_payable_payee', function (Blueprint $table) {
            $table->increments('payable_payee_id');
            $table->string('payable_check_number');
            $table->string('payable_release_date');
            $table->string('payable_check_date');
            $table->string('payable_cv_number');
            $table->string('payable_amount');
            $table->string('payable_bank_name');
            $table->string('payable_refrence_number');
            $table->string('payable_payee_created');
            $table->integer('doctor_approval_id');
            $table->integer('approval_id');
            $table->integer('provider_id');
            $table->integer('payable_id');
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
        Schema::dropIfExists('tbl_payable_payee');
    }
}
