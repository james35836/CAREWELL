<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblNewMember04062018112pm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_new_member', function (Blueprint $table) {
            $table->increments('new_member_id');
            $table->string('member_first_name');
            $table->string('member_middle_name');
            $table->string('member_last_name');
            $table->string('member_birthdate');
            $table->string('member_payment_mode');
            $table->integer('company_id');
            $table->integer('deployment_id');
            $table->integer('coverage_plan_id');
            $table->integer('cal_id');
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
