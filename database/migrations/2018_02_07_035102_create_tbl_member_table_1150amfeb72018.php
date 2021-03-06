<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblMemberTable1150amfeb72018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_member', function (Blueprint $table) {
            $table->increments('member_id');
            $table->string('member_universal_id');
            $table->string('member_first_name');
            $table->string('member_middle_name');
            $table->string('member_birthdate');
            $table->string('member_gender');
            $table->string('member_marital_status');
            $table->string('member_mother_maiden_name');
            $table->string('member_contact_number');
            $table->string('member_email_address');
            $table->string('member_permanet_address');
            $table->string('member_present_address');
            $table->string('member_created');
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
