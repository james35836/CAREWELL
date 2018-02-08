<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCompanyTable1105amfeb72018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_company', function (Blueprint $table) {
            $table->increments('company_id');
            $table->string('company_code');
            $table->string('company_name');
            $table->string('company_contact_person');
            $table->string('company_email_address');
            $table->string('company_address');
            $table->string('company_status');
            $table->string('company_contract_signed');
            $table->string('company_created');
            $table->integer('company_parent_id');
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
