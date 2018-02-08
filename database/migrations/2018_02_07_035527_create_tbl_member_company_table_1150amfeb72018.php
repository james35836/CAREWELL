<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblMemberCompanyTable1150amfeb72018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_member_company', function (Blueprint $table) {
            $table->increments('member_company_id');
            $table->string('member_carewell_id');
            $table->string('member_employee_number');
            $table->string('member_company_status');
            $table->string('member_transaction_date');
            $table->integer('coverage_plan_id');
            $table->integer('deployment_id');
            $table->integer('company_id');
            $table->integer('member_id');
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
