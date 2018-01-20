<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCompanyContractTable348jan1517 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_company_contract', function (Blueprint $table) {
            $table->increments('contract_id');
            $table->string('contract_number');
            $table->string('contract_mode_of_payment');
            $table->string('contract_image');
            $table->string('contract_schedule_of_benifits_image');
            $table->string('contract_date_created');
            $table->integer('company_id');
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
