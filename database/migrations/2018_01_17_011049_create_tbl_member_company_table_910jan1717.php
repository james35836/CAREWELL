<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblMemberCompanyTable910jan1717 extends Migration
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
            $table->string('member_company_carewell_id');
            $table->string('member_company_status');
            $table->integer('availment_plan_id');
            $table->integer('jobsite_id');
            $table->integer('member_id');
            $table->integer('company_id');
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
