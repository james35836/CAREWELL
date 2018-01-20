<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblMemberPaymentTable1114amdec2017 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_member_payment', function (Blueprint $table) {
            $table->increments('member_payment_id');
            $table->string('member_payment_amount');
            $table->string('member_payment_date_covered');
            $table->string('member_payment_status');
            $table->string('member_payment_date');
            $table->integer('member_id');
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
